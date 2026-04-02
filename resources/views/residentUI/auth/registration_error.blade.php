<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../assets/logo/eMASID.png">
    <title>eMASID - Registration Error</title>
    <!-- Dot Dot Pattern -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous" />

    <!-- css -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            height: 100vh;
            background-color: #faf7f0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 50px 20px;
            text-align: center;
        }

        .error-icon {
            font-size: 80px;
            color: #e74c3c;
            margin-bottom: 20px;
        }

        .title {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            font-weight: 900;
            color: #16522e;
            margin-bottom: 20px;
        }

        .message {
            font-family: 'Nunito Sans', sans-serif;
            font-size: 18px;
            color: #7aab8a;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .error-details {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: left;
        }

        .error-details h3 {
            font-family: 'Nunito Sans', sans-serif;
            font-size: 16px;
            color: #495057;
            margin-bottom: 10px;
        }

        .error-text {
            font-family: 'Nunito Sans', sans-serif;
            font-size: 14px;
            color: #6c757d;
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 10px;
            word-wrap: break-word;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 15px 30px;
            border-radius: 15px;
            font-family: 'Nunito Sans', sans-serif;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #0d3320;
            color: white;
            border: 2px solid #0d3320;
        }

        .btn-primary:hover {
            background-color: #16522e;
            border-color: #16522e;
        }

        .btn-secondary {
            background-color: transparent;
            color: #0d3320;
            border: 2px solid #0d3320;
        }

        .btn-secondary:hover {
            background-color: #0d3320;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>

        <h1 class="title">Registration Failed</h1>

        <p class="message">
            We encountered an error while processing your registration. Please review the details below and try again.
        </p>

        @if($errors->any())
            <div class="error-details">
                <h3>Error Details:</h3>
                <div class="error-text">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="actions">
            <a href="{{ route('register') }}" class="btn btn-primary">
                <i class="fas fa-redo"></i>
                Try Again
            </a>
            <a href="{{ route('login') }}" class="btn btn-secondary">
                <i class="fas fa-sign-in-alt"></i>
                Go to Login
            </a>
        </div>
    </div>
</body>
</html>