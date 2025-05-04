<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Challenge Submission Feedback</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f6f6f6;
            color: #333;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            border-bottom: 2px solid #007bff;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #888;
            text-align: center;
        }

        .status {
            color: #007bff;
            font-weight: bold;
        }

        .btn {
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 6px;
            display: inline-block;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Submission Feedback</h2>
        </div>

        <p>Dear Student,</p>

        <p>We have reviewed your recent challenge submission.</p>

        <p>
            <strong>Status:</strong> <span class="status">{{ $status }}</span>
        </p>

        <p>The admin has provided feedback for your submission. Please check the attached file for detailed notes and
            comments.</p>

        <p>If you have any questions, feel free to reply to this email.</p>


        <p>Thank you,<br>Admin Team</p>


        <div class="footer">
            &copy; {{ date('Y') }} Challenge Platform. All rights reserved.
        </div>
    </div>
</body>

</html>
