<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Manually require the library from your public folder
require_once public_path('fpdf/fpdf.php');

/**
 * Custom PDF Class to handle Watermarks, Clipping, Rotated Text, and Justified Bold Text
 */
class CertificatePDF extends \FPDF {
    var $angle = 0;

    // --- ROTATION LOGIC ---
    function RotatedText($x, $y, $txt, $angle) {
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }

    function Rotate($angle, $x = -1, $y = -1) {
        if($x == -1) $x = $this->x;
        if($y == -1) $y = $this->y;
        if($this->angle != 0) $this->_out('Q');
        $this->angle = $angle;
        if($angle != 0) {
            $angle *= M_PI / 180;
            $c = cos($angle);
            $s = sin($angle);
            $cx = $x * $this->k;
            $cy = ($this->h - $y) * $this->k;
            $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.5F %.5F cm 1 0 0 1 %.5F %.5F cm',
                $c, $s, -$s, $c, $cx, $cy, -$cx, -$cy));
        }
    }

    // --- CLIPPING LOGIC (To keep watermark inside borders) ---
    function ClippingRect($x, $y, $w, $h, $outline=false) {
        $op = $outline ? 'S' : 'n';
        $this->_out(sprintf('q %.2F %.2F %.2F %.2F re W %s', $x*$this->k, ($this->h-$y)*$this->k, $w*$this->k, -$h*$this->k, $op));
    }

    function UnsetClipping() {
        $this->_out('Q');
    }

    // --- JUSTIFIED BOLD TEXT LOGIC ---
    function JustifyTextWithBold($parts, $w, $h) {
        $xStart = $this->GetX();
        $lines = [];
        $currentLine = [];
        $lineWidth = 0;

        foreach ($parts as $part) {
            $text = $part[0];
            $isBold = $part[1];
            $words = explode(' ', $text);
            
            foreach ($words as $word) {
                if ($word === '') continue;
                
                $this->SetFont('Times', $isBold ? 'B' : '', 14);
                $wordWidth = $this->GetStringWidth($word);
                $spaceWidth = $this->GetStringWidth(' ');

                if ($lineWidth + $wordWidth > $w && !empty($currentLine)) {
                    $lines[] = ['words' => $currentLine, 'width' => $lineWidth];
                    $currentLine = [];
                    $lineWidth = 0;
                }
                
                $currentLine[] = ['text' => $word, 'bold' => $isBold, 'width' => $wordWidth];
                $lineWidth += $wordWidth + $spaceWidth;
            }
        }
        $lines[] = ['words' => $currentLine, 'width' => $lineWidth, 'last' => true];

        foreach ($lines as $line) {
            $words = $line['words'];
            $numWords = count($words);
            
            if ($numWords > 1 && !isset($line['last'])) {
                $totalWordWidth = 0;
                foreach ($words as $wData) $totalWordWidth += $wData['width'];
                $spacing = ($w - $totalWordWidth) / ($numWords - 1);
            } else {
                $spacing = $this->GetStringWidth(' ');
            }

            foreach ($words as $wData) {
                $this->SetFont('Times', $wData['bold'] ? 'B' : '', 14);
                $this->Cell($wData['width'], $h, $wData['text'], 0, 0, 'L');
                $this->SetX($this->GetX() + $spacing);
            }
            $this->Ln($h);
            $this->SetX($xStart);
        }
    }
}

class CertificateController extends Controller
{
    public function index() {
        $certificates = DB::table('student_certificates')->orderBy('id', 'desc')->get();
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create() {
        return view('admin.certificates.create');
    }

    public function store(Request $request) {
        $data = $request->except('_token');
        DB::table('student_certificates')->insert($data);
        return redirect()->route('certificates.index')->with('success', 'Certificate added successfully!');
    }

    public function edit($id) {
        $certificate = DB::table('student_certificates')->where('id', $id)->first();
        if (!$certificate) {
            return redirect()->route('certificates.index')->with('error', 'Record not found.');
        }
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, $id) {
        $data = $request->except(['_token', '_method']);
        DB::table('student_certificates')->where('id', $id)->update($data);
        return redirect()->route('certificates.index')->with('success', 'Certificate updated!');
    }

    public function destroy($id) {
        DB::table('student_certificates')->where('id', $id)->delete();
        return back()->with('success', 'Record removed.');
    }

    public function print($id) {
        $certificate = DB::table('student_certificates')->where('id', $id)->first();

        if (!$certificate) {
            abort(404, 'Certificate not found.');
        }

        $data = (array) $certificate;
        $pdf = new CertificatePDF('L', 'mm', 'A4');
        $pdf->AddPage();

        /* COLORS */
        $customBlue = [0, 51, 102]; 

        /* WATERMARK (Moved before Border so it stays "behind") */
        // We set a clipping rectangle slightly smaller than the outer border (13mm to 284mm)
        $pdf->ClippingRect(13, 13, 271, 184); 
        
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetTextColor(242, 242, 242); // Very light grey
        for ($y = 20; $y <= 210; $y += 35) {
            for ($x = 0; $x <= 300; $x += 60) {
                $pdf->RotatedText($x, $y, 'API-CTEVT', 45);
            }
        }
        $pdf->UnsetClipping(); // Stop clipping so borders draw normally

        /* BORDERS */
        $pdf->SetDrawColor(...$customBlue);
        $pdf->SetLineWidth(2.2);
        $pdf->Rect(10, 10, 277, 190); // Outer
        $pdf->SetLineWidth(0.6);
        $pdf->Rect(13, 13, 271, 184); // Inner

        /* HEADER */
        $pdf->Image('https://abps.edu.np/assets/img/logo.png', 22, 22, 28);
        $pdf->SetFont('Times', 'B', 16);
        $pdf->SetTextColor(...$customBlue);
        $pdf->SetXY(65, 24);
        $pdf->Cell(170, 8, 'Council for Technical Education and Vocational Training', 0, 1, 'C');
        $pdf->SetFont('Times', 'B', 19);
        $pdf->SetXY(65, 33);
        $pdf->Cell(170, 7, 'ANNAPURNA POLYTECHNIC INSTITUTE', 0, 1, 'C');
        $pdf->SetFont('Times', '', 11);
        $pdf->SetXY(65, 41);
        $pdf->Cell(170, 6, 'Annapurna 3, Kahundanda, Kaski', 0, 1, 'C');

        /* PHOTO BOX */
        $pdf->SetDrawColor(200, 200, 200);
        $pdf->Rect(245, 22, 32, 38);

        /* ISSUE NUMBER */
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetTextColor(...$customBlue);
        $pdf->SetXY(22, 58);
        $pdf->Cell(80, 6, 'Issue No: ' . $data['issue_no'], 0, 0);

        /* TITLE */
        $pdf->SetY(72);
        $pdf->SetFont('Times', 'B', 22);
        $pdf->SetTextColor(...$customBlue);
        $pdf->Cell(0, 12, 'CHARACTER / TRANSFER CERTIFICATE', 0, 1, 'C');

        /* MAIN BODY TEXT */
        $pdf->SetLeftMargin(28);
        $pdf->SetRightMargin(28);
        $pdf->SetY(95);
        $pdf->SetTextColor(...$customBlue); 
        $lh = 9;

        $parentName = $data['father_name'] ?: $data['mother_name'];
        $passYear = $data['pass_year'] ?? $data['year_to'];

        $parts = [
            ["This is to certify that ", false],
            [$data['full_name'], true],
            [", son/daughter of Mr. / Mrs. ", false],
            [$parentName, true],
            [", resident of ", false],
            [$data['municipality'], true],
            [", ward no. ", false],
            [$data['ward_number'], true],
            [" of District ", false],
            [$data['district'], true],
            [" and province ", false],
            [$data['province'], true],
            [" had been a bonafide student of this institute from ", false],
            [$data['year_from'], true],
            [" to ", false],
            [$data['year_to'], true],
            [" BS. He/She has successfully completed the final exam of the three years ", false],
            [$data['course'], true],
            [" course conducted by CTEVT in ", false],
            [$passYear, true],
            [" with ", false],
            [$data['division'], true],
            [" division and ", false],
            [$data['percentage'] . "%", true],
            [" marks according to API record. His/her date of birth is ", false],
            [$data['dob_nepali'], true],
            [". We know nothing against his/her moral character.", false]
        ];

        $pdf->JustifyTextWithBold($parts, 241, $lh);

        /* REGISTRATION & DATE */
        $pdf->SetY(155);
        $pdf->SetTextColor(...$customBlue);
        $pdf->SetFont('Times', 'B', 12); 
        $pdf->Cell(100, 6, 'CTEVT Reg No : ' . $data['ctevt_reg_no'], 0, 1);
        $pdf->Cell(100, 6, 'Issue Date     : ' . $data['issue_date_nepali'], 0, 1);

        /* SIGNATURE SECTION */
        $pdf->SetY(175);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->Cell(85, 5, '____________________', 0, 0, 'C');
        $pdf->Cell(85, 5, '____________________', 0, 0, 'C');
        $pdf->Cell(85, 5, '____________________', 0, 1, 'C');
        $pdf->Cell(85, 7, 'Prepared By', 0, 0, 'C');
        $pdf->Cell(85, 7, 'Checked By', 0, 0, 'C');
        $pdf->Cell(85, 7, 'Principal', 0, 1, 'C');

        return response($pdf->Output('S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Certificate_' . $data['full_name'] . '.pdf"');
    }
}