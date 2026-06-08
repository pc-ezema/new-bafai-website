<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to BAFAI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .header {
            background: linear-gradient(135deg, #503a98, #3b2a73);
            color: white;
            text-align: center;
            padding: 30px 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
            color: #333;
            line-height: 1.5;
        }
        .button {
            display: inline-block;
            background: #21a37a;
            color: white !important;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 50px;
            margin: 15px 0;
            font-weight: bold;
        }
        .info-box {
            background: #f1f5f9;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .info-box p {
            margin: 5px 0;
        }
        ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .footer {
            background: #f1f5f9;
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
        a {
            color: #503a98;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Dear {{ $firstname }},</h1>
            <p>Welcome to BAFAI! We're excited to have you join our community of AI learners.</p>
        </div>

        <div class="content">
            <!-- <p><strong>Onboarding Pack:</strong><br>
            <a href="https://drive.google.com/file/d/1VupLU1_2kmOQ6iTA79iQRnGCoI6HshdR/view" target="_blank">📘 Access your onboarding pack</a></p> -->

            <!-- <p>The onboarding pack contains:</p>
            <ul>
                <li>Course details and schedules</li>
                <li>Access to learning platforms and resources</li>
                <li>Guidelines for communication and community engagement</li>
                <li>Technical setup requirements</li>
                <li>Social media links</li>
                <li>Other BAFAI information</li>
            </ul> -->

            <!-- <p><strong>User Guide:</strong><br>
            <a href="https://www.youtube.com/watch?v=zyfYBrcShqE" target="_blank">🎥 Watch the user guide video</a></p> -->

            <!-- <p><strong>Course Timetable:</strong><br>
            <a href="https://docs.google.com/spreadsheets/d/1l3--xenrtpCi6eM22ze8j3K_FPLVLFmF9yhTvMxgYCk/edit?usp=sharing" target="_blank">📅 Download your course timetable</a></p> -->

            <div class="info-box">
                <p><strong>Your login details:</strong></p>
                <p>🔐 Login page: <a href="https://learn.bafai.ai/login/?lang=en">https://learn.bafai.ai/login/?lang=en</a></p>
                <p>👤 Username: <strong>{{ $username }}</strong></p>
                <p>🔑 Password: <strong>{{ $password }}</strong></p>
                <p><em>We strongly recommend changing your password after your first login.</em></p>
            </div>

            <!-- <p><strong>Join your cohort community:</strong><br>
            <a href="https://chat.whatsapp.com/EgSTR0G5naxHURetcOArKB?mode=gi_t">💬 WhatsApp Cohort Group</a></p>

            <p>Kindly review the documents and feel free to reach out with any questions.</p> -->

            <p><strong>Welcome aboard!</strong></p>

            <p>
                Dr. Lola Olukuewu<br>
                Founder, BAFAI
            </p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} BAFAI. All rights reserved.<br>
            You're receiving this email because you registered on our platform.
        </div>
    </div>
</body>
</html>