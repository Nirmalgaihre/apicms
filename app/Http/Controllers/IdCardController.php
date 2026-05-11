<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdCard;
use Illuminate\Support\Facades\Storage;

// Manually require the library from your public folder
require_once public_path('fpdf/fpdf.php');

class IdCardController extends Controller
{
    public function index() {
        $cards = IdCard::orderBy('created_at', 'desc')->get();
        return view('admin.id_cards.index', compact('cards'));
    }

    public function create() {
        return view('admin.id_cards.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'profile_image' => 'required|image|max:2048',
        ]);

        $card = new IdCard();
        $this->saveData($card, $request);
        return redirect()->route('id_cards.index')->with('success', 'Generated Successfully!');
    }

    public function edit($id) {
        $card = IdCard::findOrFail($id);
        return view('admin.id_cards.edit', compact('card'));
    }

    public function update(Request $request, $id) {
        $request->validate(['name' => 'required', 'profile_image' => 'nullable|image|max:2048']);
        $card = IdCard::findOrFail($id);
        $this->saveData($card, $request);
        return redirect()->route('id_cards.index')->with('success', 'Updated Successfully!');
    }

    public function destroy($id) {
        $card = IdCard::findOrFail($id);
        if ($card->profile_image) { 
            Storage::disk('public')->delete($card->profile_image); 
        }
        $card->delete();
        return redirect()->route('id_cards.index')->with('success', 'Deleted Successfully!');
    }

    private function saveData($card, $request) {
        $card->name = $request->name;
        $card->program = $request->program;
        $card->address = $request->address;
        $card->batch = $request->batch;
        $card->mobile_number = $request->mobile_number;
        $card->expire_date = $request->expire_date;
        if ($request->hasFile('profile_image')) {
            if ($card->profile_image) { 
                Storage::disk('public')->delete($card->profile_image); 
            }
            $card->profile_image = $request->file('profile_image')->store('id_cards', 'public');
        }
        $card->save();
    }

    /**
     * Generate ID Card PDF using FPDF
     */
    public function generatePDF($id) {
        $row = IdCard::findOrFail($id);
        
        // --- Theme Colors ---
        $primaryColor = [0, 51, 102];    // Navy Blue
        $accentColor  = [194, 153, 33];  // Golden Yellow

        // --- PDF Configuration ---
        $width = 85;
        $height = 125;
        $pdf = new \FPDF('P', 'mm', array($width, $height));
        $pdf->SetAutoPageBreak(false); 
        $pdf->AddPage();

        // --- 1. Background & Border ---
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Rect(0, 0, $width, $height, 'F'); 
        $pdf->SetDrawColor(...$primaryColor); 
        $pdf->SetLineWidth(1.0);
        $pdf->Rect(2, 2, 81, 121); 

        // --- 2. Header Section ---
        $pdf->SetFillColor(...$primaryColor);
        $pdf->Rect(2, 2, 81, 25, 'F'); 

        // Logo - Using a remote or local path
        $logoUrl = 'https://abps.edu.np/assets/img/logo.png';
        $pdf->Image($logoUrl, 5, 5, 16); 

        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(22, 6);
        $pdf->MultiCell(60, 4, "ANNAPURNA\nPOLYTECHNIC INSTITUTE", 0, 'C');
        $pdf->SetXY(22, 16);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(60, 4, "Annapurna 3, Kahundanda, Kaski | 
985-6080460", 0, 0, 'C');

        // --- 3. Profile Picture (PP Size: 35x40mm) ---
        $imgW = 35; 
        $imgH = 40; 
        $imageX = ($width - $imgW) / 2;
        $pdf->SetDrawColor(200, 200, 200);

        // Path to storage in Laravel
        $profilePath = public_path('storage/' . $row->profile_image);
        
        if (!empty($row->profile_image) && file_exists($profilePath)) {
            $pdf->Image($profilePath, $imageX, 32, $imgW, $imgH);
            $pdf->SetDrawColor(...$primaryColor);
            $pdf->Rect($imageX, 32, $imgW, $imgH); 
        } else {
            $pdf->Rect($imageX, 32, $imgW, $imgH);
            $pdf->SetXY($imageX, 48);
            $pdf->SetTextColor(150, 150, 150);
            $pdf->Cell($imgW, 10, 'NO PHOTO', 0, 0, 'C');
        }

        // --- 4. Content Block (Name Section) ---
        $pdf->SetY(75); 
        $name = strtoupper($row->name);
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->SetTextColor(...$primaryColor);

        // Manual Centering
        $nameWidth = $pdf->GetStringWidth($name);
        $centerX = ($width - $nameWidth) / 2;
        $pdf->SetX($centerX); 
        $pdf->Cell($nameWidth, 8, $name, 0, 1, 'L'); 

        // Separator Line
        $lineWidth = 50; 
        $lineX = ($width - $lineWidth) / 2;
        $pdf->SetDrawColor(...$accentColor);
        $pdf->SetLineWidth(0.6);
        $pdf->Line($lineX, 83, $lineX + $lineWidth, 83); 
        $pdf->Ln(4);

        // --- 5. Info Table ---
        $fields = [
            'PROGRAM' => $row->program,
            'BATCH'   => $row->batch,
            'PHONE'   => $row->mobile_number,
            'ADDRESS' => $row->address,
            'EXPIRE'  => $row->expire_date
        ];

        foreach ($fields as $label => $val) {
            $pdf->SetX(12);
            $pdf->SetTextColor(...$primaryColor);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Cell(18, 6, $label . " :", 0, 0, 'L');
            
            $pdf->SetFont('Arial', '', 8);
            if($label == 'ADDRESS') {
                $pdf->MultiCell(45, 6, $val, 0, 'L');
            } else {
                $pdf->Cell(45, 6, $val, 0, 1, 'L');
            }
        }

        // --- 6. Decorative Footer ---
        $pdf->SetFillColor(...$primaryColor);
        $pdf->Rect(2, 120, 81, 3, 'F');

        // Output the PDF
        return response($pdf->Output('S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Student_ID_' . $row->id . '.pdf"');
    }
}