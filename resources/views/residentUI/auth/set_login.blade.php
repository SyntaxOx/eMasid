<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../assets/logo/eMASID.png">
    <title>eMASID - Email & Address</title>
    <!-- Dot Dot Pattern -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous" />

    <!-- css -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

        .hidden {
            display: none;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            height: 100vh;
        }

        .left-content {
            position: relative;
            width: 100%;
            background-color: #0d3320;
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 100px;
            user-select: none;
            pointer-events: none;
        }

        .left-content .semi-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            flex: 1;
            justify-content: center;
        }

        .left-content .icon {
            position: relative;
            width: 85px;
            height: 95px;
        }

        .left-content .icon .eMASID-icon {
            width: 100%;
            height: 100%;
        }


        .left-content .title {
            position: relative;
            font-family: 'Playfair Display', serif;
            font-size: 4.4rem;
            font-weight: 900;
            line-height: 1;
            color: white;
            letter-spacing: -1px;
            animation: fadeUp .85s .08s ease both;

        }

        .left-content .title span {
            color: #e8b94f;
        }

        .left-content .tagline {
            color: #c8e6d0;
            font-family: 'Nunito Sans', sans-serif;
            font-weight: 300;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 13px;
        }

        .left-content .description {
            font-family: 'Nunito Sans', sans-serif;
            position: relative;
            margin-top: 15px;
            max-width: 360px;
            font-size: 15px;
            font-weight: 400;
            color: #7aab8a;
            line-height: 1.75;
            animation: fadeUp .85s .24s ease both;
        }

        .left-content .steps-container {
            display: flex;
            justify-content: space-around;
            padding: 0 50px;
            font-family: 'Nunito Sans', sans-serif;
        }

        .left-content .step {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: #e8b94f;
        }

        .left-content .step span {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid #e8b94f;
            color: #e8b94f;
            font-size: 18px;
        }

        .left-content .step.current span {
            background-color: #e8b94f;
            color: #16522e;
            font-weight: 600;
        }

        .right-content {
            width: 100%;
            background-color: #faf7f0;
            display: flex;
            flex-direction: column;
            gap: 30px;
            justify-content: center;
            position: relative;
        }

        .right-content .form-header {
            font-size: 13px;
            font-weight: 300;
            color: #1f7a43;
            letter-spacing: 1.3px;
            text-transform: uppercase;
            margin-bottom: 10px;
            font-family: 'Nunito Sans', sans-serif;
            user-select: none;
            margin: 0 50px;
        }

        .right-content h2 {
            color: #16522e;
            font-family: 'Playfair Display', serif;
            font-size: 35px;
            font-weight: 900;
        }

        .right-content .map {
            width: calc(100% - 150px);
            height: 200px;
            background-color: red;
            margin: 0 75px;
            border-radius: 15px;
        }

        .right-content form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            user-select: none;
            margin: 0 50px;
        }

        .right-content .secure {
            display: flex;
            gap: 15px;
        }

        .right-content .field {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-top: 10px;
            font-family: 'Nunito Sans', sans-serif;
            color: #16522e;
            font-weight: 700;
            width: 100%;
            font-size: 13px;
        }

        .right-content .inputField {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            background-color: white;
            border-radius: 5px;
            padding: 15px 20px;
        }

        .right-content .inputField input {
            font-family: 'Nunito Sans', sans-serif;
            border: none;
            width: 100%;
            outline: none;
            font-size: 13px;
            user-select: auto;
        }

        .right-content .strongPassword {
            width: 100%;
            height: 3px;
            background-color: rgb(209, 209, 209);
            border-radius: 10px;
        }

        .right-content .indicator {
            width: 0%;
            height: 3px;
            background: linear-gradient(to right, #16522e, #1f7a43, #1f7a43);
            border-radius: 10px;
            transition: all 0.5s linear;
        }

        .right-content .otp {
            padding-bottom: 30px;
            display: flex;
            gap: 20px;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito Sans', sans-serif;
        }

        .right-content .otp button {
            border-radius: 10px;
            font-size: 15px;
            padding: 15px;
            width: 150px;
            outline: none;
            border: 2px solid #16522e;
            cursor: pointer;
            transform: translateY(16px);
            color: #16522e;
            transition: all 0.1s linear;
        }

        .right-content .otp button:hover {
            transform: translateY(16px) scale(1.04);
        }

        .right-content .passBasis {
            background-color: rgb(240, 240, 240);
            border-radius: 20px;
            padding: 25px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: fit-content;
        }

        .right-content .requirement {
            display: flex;
            gap: 10px;
            align-items: center;
            font-family: 'Nunito Sans', sans-serif;
            font-size: 15px;
        }

        .right-content .passBasis .circle {
            background-color: #fff;
            border: 1px solid #16522e;
            width: 15px;
            height: 15px;
            border-radius: 50%;
        }

        .right-content .actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-top: 35px;
        }

        .right-content .buttons-back {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 2px solid #0d3320;
            border-radius: 15px;
            padding: 15px;
            width: 150px;
            font-size: 13px;
            font-family: 'Nunito Sans', sans-serif;
        }

        .right-content .buttons-back .btn-arrow {
            transition: all 0.3s linear;
        }

        .right-content .buttons-back:hover .btn-arrow {
            transform: translateX(-7px);
        }

        .right-content .buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: none;
            border-radius: 15px;
            padding: 15px;
            background-color: #0d3320;
            font-family: 'Nunito Sans', sans-serif;
            transition: all 0.3s linear;
            flex: 1;
        }

        .right-content .buttons span {
            font-size: 13px;
            color:white;
            letter-spacing: 1px;
            font-weight: 600;
            transition: all 0.3s linear;
        }

        .right-content .buttons:hover .btn-arrow {
            transform: translateX(7px);
        }

        .right-content .buttons:hover {
            background: #16522e;
        }

        .dot-grid {
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, #f5d27a3b 1px, transparent 1px);
            background-size: 28px 28px;
            mask-image: radial-gradient(ellipse 40% 40% at 20% 50%, rgb(255, 255, 255) 50%, transparent 100%);
        }

        .ring-extra {
            position: absolute;
            border-radius: 50%;
            border: 1px solid #e8ba4f3f;
            pointer-events: none;
            width: 700px; 
            height: 700px;
            top: 0px; 
            left: -150px;
        }

        .right-content button.unable {
            background-color: #cecece;
            border: 1px solid #cecece;
            pointer-events: none;
            cursor: not-allowed;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="left-content">
    <div class="semi-container">
        <div class="dot-grid"></div>
        <div class="ring-extra"></div>

        <div class="icon">
            <img src="../../assets/logo/eMASID.png" alt="eMASID" class="eMASID-icon">
        </div>

        <h1 class="title">e<span>MASID</span></h1>
        <p class="tagline">Registration</p>
        <p class="description">Empowering Filipino communities to report, track, and resolve local issues — transparently and collectively.</p>
    </div>

    <div class="steps-container">
        <div class="step"><span>✓</span><label>Personal Information</label></div>
        <div class="step"><span>✓</span><label>Address</label></div>
        <div class="step current"><span>3</span><label>Email & Password</label></div>
    </div>
</div>

<div class="right-content">
    <div class="form-header">
        <p>Step 3 of 3</p>
        <h2>Email & Password</h2>
    </div>

    <form action="{{ route('register.step3') }}" method="post">
        @csrf

        <!-- Email & Phone -->
        <div class="secure">
            <div class="field">
                <label for="email">Email Address</label>
                <div class="inputField">
                    <i class="fa-regular fa-envelope"></i>
                    <input id="emailField" name="email" type="email" required placeholder="your.email@gmail.com">
                </div>
            </div>
            <div class="field">
                <label for="phoneNum">Phone No.</label>
                <div class="inputField">
                    <i class="fa-solid fa-phone"></i>
                    <input type="text" name="phone" id="phoneNum" required placeholder="0917 123 4567">
                </div>
            </div>
        </div>

        <!-- OTP -->
        <div class="otp">
            <button type="button" class="sendOtp unable" id="sendOtp">Send OTP</button>
            <div class="field">
                <label for="otp">OTP</label>
                <div class="inputField">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="text" name="otp" placeholder="OTP" required>
                </div>
            </div>
        </div>

        <!-- Password & Confirm -->
        <div class="secure">
            <div class="field">
                <label for="password">Password</label>
                <div class="inputField">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" placeholder="Password" name="password" required class="password">
                    <div class="eyeIcon"><i class="fa-solid fa-eye"></i></div>
                </div>
                <div class="strongPassword"><div class="indicator"></div></div>
            </div>
            <div class="field">
                <label for="password_confirmation">Confirm Password</label>
                <div class="inputField">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" placeholder="Confirm Password" name="password_confirmation" required class="password">
                    <div class="eyeIcon"><i class="fa-solid fa-eye"></i></div>
                </div>
            </div>
        </div>

        <!-- Password Requirements -->
        <div class="passBasis">
            <div class="requirement"><div class="circle"></div><span>Capital Letter</span></div>
            <div class="requirement"><div class="circle"></div><span>Small Letter</span></div>
            <div class="requirement"><div class="circle"></div><span>Minimum 8 Characters</span></div>
            <div class="requirement"><div class="circle"></div><span>Number</span></div>
            <div class="requirement"><div class="circle"></div><span>Special Character</span></div>
        </div>

        <!-- Actions -->
        <div class="actions">
            <button type="button" class="buttons-back" id="back-btn">
                <span class="btn-arrow">←</span>
                <span>Back</span>
            </button>
            <button type="submit" class="buttons" id="createAccount">
                <span>Next Step</span>
                <span class="btn-arrow">→</span>
            </button>
        </div>
    </form>
</div>
</body>
</html>