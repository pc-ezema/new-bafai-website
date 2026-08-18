<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Confirmation</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 0;
            color: #1e293b;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #503a98, #3b2a73);
            padding: 2rem 2.5rem;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            font-size: 1.8rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.5px;
        }
        .header p {
            color: rgba(255, 255, 255, 0.85);
            margin: 0.5rem 0 0;
            font-size: 1rem;
        }
        .body {
            padding: 2.5rem;
        }
        .greeting {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #0f172a;
        }
        .sub-greeting {
            color: #64748b;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }
        .divider {
            border: none;
            border-top: 2px solid #f1f5f9;
            margin: 1.5rem 0;
        }
        .course-list {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            margin: 1.25rem 0;
        }
        .course-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #e9ecef;
            list-style: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .course-list li:last-child {
            border-bottom: none;
        }
        .course-list li::before {
            content: "✅";
            font-size: 1rem;
        }
        .cohort-box {
            background: #f1f5f9;
            border-left: 4px solid #503a98;
            padding: 1rem 1.25rem;
            border-radius: 0 8px 8px 0;
            margin: 1.25rem 0;
        }
        .cohort-box strong {
            color: #0f172a;
        }
        .cohort-box .highlight {
            color: #503a98;
            font-weight: 700;
        }
        .next-steps {
            background: #f0fdf4;
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            margin: 1.25rem 0;
            border: 1px solid #dcfce7;
        }
        .next-steps h4 {
            color: #166534;
            margin: 0 0 0.5rem 0;
            font-size: 1rem;
        }
        .next-steps ul {
            margin: 0;
            padding-left: 1.25rem;
            color: #166534;
        }
        .next-steps ul li {
            margin-bottom: 0.35rem;
        }
        .footer {
            padding: 1.5rem 2.5rem;
            background: #f8fafc;
            text-align: center;
            border-top: 1px solid #e9ecef;
            color: #64748b;
            font-size: 0.85rem;
        }
        .footer a {
            color: #503a98;
            text-decoration: none;
            font-weight: 600;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .badge {
            display: inline-block;
            background: #21a37a;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #503a98, #3b2a73);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 2rem;
            text-decoration: none;
            font-weight: 700;
            margin-top: 0.5rem;
            transition: all 0.3s;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(80, 58, 152, 0.3);
            color: white;
        }
        @media (max-width: 480px) {
            .header { padding: 1.5rem; }
            .body { padding: 1.5rem; }
            .footer { padding: 1.25rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🎓 Enrollment Confirmed</h1>
            <p>Welcome to the BAFAI Learning Community</p>
        </div>

        <!-- Body -->
        <div class="body">
            <p class="greeting">Hello, {{ $user->firstname }}! 👋</p>
            <p class="sub-greeting">
                We are delighted to confirm your enrollment in the following course(s):
            </p>

            <!-- Course List -->
            <ul class="course-list">
                @foreach($courses as $course)
                    <li><strong>{{ $course->fullname }}</strong></li>
                @endforeach
            </ul>

            <hr class="divider">

            <!-- Cohort Information -->
            <div class="cohort-box">
                <p style="margin: 0; font-size: 0.95rem;">
                    <strong>📅 Cohort-Based Learning</strong><br>
                    Your courses are delivered in <span class="highlight">cohorts</span> — a structured, 
                    collaborative learning experience where you progress alongside a group of peers.
                </p>
            </div>

            <p style="color: #475569; font-size: 0.95rem;">
                <strong>🗓️ When does your cohort start?</strong><br>
                We are currently finalizing the schedule for the upcoming cohort. 
                <strong>You will receive a separate notification</strong> with the exact 
                start date, orientation details, and access instructions before the cohort begins.
            </p>

            <!-- Next Steps -->
            <div class="next-steps">
                <h4>📋 What to Expect Next</h4>
                <ul>
                    <li>You will receive a welcome email with cohort start details.</li>
                    <li>You'll gain access to the learning platform on Day 1.</li>
                    <li>Our team will reach out with orientation information.</li>
                    <li>You'll be able to connect with fellow learners in your cohort.</li>
                </ul>
            </div>

            <p style="color: #475569; font-size: 0.95rem; margin-top: 1.25rem;">
                If you have any questions in the meantime, please don't hesitate to 
                reach out to our support team.
            </p>

            <div style="text-align: center; margin-top: 1.5rem;">
                <a href="https://bafai.ai" class="btn">Visit BAFAI</a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p style="margin: 0;">
                &copy; {{ date('Y') }} <strong>BAFAI</strong> — Bloom Academy for Artificial Intelligence<br>
                <a href="mailto:support@bafai.ai">support@bafai.ai</a> &bull; 
                <a href="https://bafai.ai">bafai.ai</a>
            </p>
        </div>
    </div>
</body>
</html>