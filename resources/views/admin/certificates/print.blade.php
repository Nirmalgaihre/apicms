<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate - {{ $certificate->full_name }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Great+Vibes&family=Montserrat:wght@400;700&display=swap');

        @media print {
            .no-print { display: none !important; }
            body { padding: 0; margin: 0; }
            .cert-card { border: none !important; box-shadow: none !important; }
        }

        body {
            background-color: #f1f5f9;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
        }

        .cert-card {
            background: white;
            width: 900px;
            height: 650px;
            padding: 50px;
            border: 15px solid #1d0647;
            position: relative;
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1);
            background-image: url('https://www.transparenttextures.com/patterns/white-paper.png');
        }

        .inner-border {
            border: 2px solid #fbbf24;
            height: 100%;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-sizing: border-box;
            padding: 40px;
        }

        .header h1 {
            font-family: 'Cinzel', serif;
            color: #1d0647;
            font-size: 45px;
            margin: 0;
            letter-spacing: 5px;
        }

        .header p {
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: bold;
            color: #fbbf24;
            margin-top: 5px;
        }

        .cert-body {
            text-align: center;
            margin-top: 30px;
            line-height: 1.8;
            font-size: 18px;
            color: #334155;
        }

        .student-name {
            font-family: 'Great Vibes', cursive;
            font-size: 55px;
            color: #1d0647;
            margin: 15px 0;
            display: block;
        }

        .bold { font-weight: 700; color: #0f172a; }

        .footer {
            margin-top: auto;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 40px 20px;
        }

        .sig-box {
            text-align: center;
            width: 200px;
        }

        .sig-line {
            border-top: 2px solid #1d0647;
            margin-bottom: 10px;
        }

        .sig-text {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: bold;
            color: #64748b;
        }

        .no-print {
            margin-bottom: 20px;
        }

        .print-btn {
            background: #1d0647;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button onclick="window.print()" class="print-btn">
            <i class="fa-solid fa-print"></i> PRINT CERTIFICATE
        </button>
    </div>

    <div class="cert-card">
        <div class="inner-border">
            <div class="header">
                <p>Issue No: {{ $certificate->issue_no }}</p>
                <h1>Character Certificate</h1>
                <p>Annapurna Polytechnic Institute</p>
            </div>

            <div class="cert-body">
                This is to certify that <br>
                <span class="student-name">{{ $certificate->full_name }}</span>
                Son/Daughter of <span class="bold">{{ $certificate->father_name }}</span> & <span class="bold">{{ $certificate->mother_name }}</span> <br>
                having CTEVT Registration No: <span class="bold">{{ $certificate->ctevt_reg_no }}</span> <br>
                has successfully completed <span class="bold">{{ $certificate->course }}</span> <br>
                conducted by this Institute during the period <span class="bold">{{ $certificate->year_from }} BS</span> to <span class="bold">{{ $certificate->year_to }} BS</span>. <br>
                He/She has secured <span class="bold">{{ $certificate->percentage }}%</span> and was awarded <span class="bold">{{ $certificate->division }}</span>.
            </div>

            <div class="footer">
                <div class="sig-box">
                    <div class="sig-line"></div>
                    <div class="sig-text">Prepared By</div>
                </div>
                <div class="sig-box">
                    <div class="sig-line"></div>
                    <div class="sig-text">Date of Issue: {{ $certificate->issue_date_nepali }}</div>
                </div>
                <div class="sig-box">
                    <div class="sig-line"></div>
                    <div class="sig-text">Principal</div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>