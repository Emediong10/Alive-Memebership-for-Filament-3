<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happy Birthday</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f9ff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 600px;
            background-color: #e7f3ff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            position: relative;
        }
        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://i.imgur.com/8VnUfxp.png') no-repeat center;
            background-size: cover;
            opacity: 0.2;
            z-index: 0;
        }
        .content {
            position: relative;
            z-index: 1;
        }
        #logo img {
            max-width: 100px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #4A90E2;
            margin-bottom: 10px;
            font-size: 32px;
        }
        .message {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .message h2 {
            color: #333;
            margin-bottom: 10px;
        }
        .message p {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
        .footer a {
            color: #4A90E2;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            {{-- <div id="logo">
                <img src="{{ url('assets/images/Aliveng.png') }}" alt="Alive Logo">
            </div> --}}
            <div class="header">
                <h1>🎉 Happy Birthday! 🎉</h1>
            </div>
            <!-- Message -->
            <div class="message">
                <h2>Dear {{ $user->name }},</h2>
                <p>
                    Wishing you a fantastic birthday filled with love, laughter, and joy.</p>

                  <p>  May your life be enriched with God's blessings, grace, and abundant happiness.
                </p>
                <p><strong>“The Lord bless you and keep you; the Lord make His face shine upon you and be gracious to you.” – Numbers 6:24-25</strong></p>
                <p>
                    Have an amazing day filled with wonderful memories! We are so glad to have you as part of the ALIVE-Nigeria family.
                </p>
            </div>
            <!-- Footer -->
            <div class="footer">
                <p>With warm regards,</p>
                <p><strong>ALIVE-Nigeria</strong></p>
                <p><a href="https://www.alivenigeria.org">Visit our website</a></p>
            </div>
        </div>
    </div>
</body>
</html>
