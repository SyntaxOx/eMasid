<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../assets/logo/eMASID.png">
    <title>eMASID - Registration</title>
    <!-- Dot Dot Pattern -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
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
            position: relative;
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

        .errorContainer {
            display: none;
            position: absolute;
            background-color: white;
            top: -100px;
            right: 50%;
            transform: translateX(50%);
            z-index: 1000;
            height: 50px;
            width: 350px;
            justify-content: center;
            align-items: center;
            border-radius: 15px;
            color: red;
            font-family: 'Nunito Sans', sans-serif;
            border: 1px solid red;
            transition: all 0.5s ease;
            opacity: 0;
        }

        .errorContainer.show {
            top: 5%;
            opacity: 1;
        }

        .right-content {
            width: 100%;
            background-color: #faf7f0;
            display: flex;
            flex-direction: column;
            gap: 50px;
            justify-content: center;
        }

        .right-content .form-header {
            font-size: 15px;
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
            font-size: 40px;
            font-weight: 900;
        }

        .right-content form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            user-select: none;
            margin: 0 50px;
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
            font-size: 18px;
            user-select: auto;
        }

        .pamilyName, .personalAdditional {
            display: flex;
            gap: 10px;
            justify-content: space-between;
            gap: 15px;
        }

        .right-content .inputField select {
            font-family: 'Nunito Sans', sans-serif;
            border: none;
            width: 100%;
            outline: none;
            font-size: 18px;
            user-select: auto;
        }



        .right-content .divider {
            margin: 0 50px;
            background-color: #96969648;
            height: 1px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Nunito Sans', sans-serif;
        }

        .right-content .remember {
            display: flex;
            justify-content: space-between;
            padding: 0 10px;
            font-family: 'Nunito Sans', sans-serif;
            font-size: 14px;
            color: #727272;
        }

        .right-content .rememberMe {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .right-content .remember a {
            color: #1f7a43;
            font-weight: 700;
            text-decoration: none;
        }

        .right-content .remember a:hover {
            color: #0d3320;
        }

        .right-content .buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 25px;
            border: none;
            border-radius: 15px;
            padding: 20px;
            background-color: #0d3320;
            font-family: 'Nunito Sans', sans-serif;
            transition: all 0.3s linear;
        }

        .right-content .buttons span {
            font-size: 18px;
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

        .right-content .divider a {
            background-color: #faf7f0;
            color: #69ad85;
            width: fit-content;
            display: flex;
            gap: 5px;
            justify-content: center;
            padding: 0 15px;
            text-decoration: none;
        }

        .right-content .divider a:hover {
            color: #1d6b3e;
        }

        .right-content .divider span {
            color: #969696;
        }

        .right-content .form-footer {
            margin-top: 60px;
            font-size: .75rem;
            color: #9ab5a2;
            line-height: 1.6;
            animation: fadeRight .85s .66s ease both;
            display: flex;
            justify-content: center;
            gap: 5px;
            user-select: none;
        }

        .right-content .form-footer a {
            color: #0d3320;
            cursor: pointer;
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
    </style>
</head>
<body>
    <div class="errorContainer" id="errorContainer">
        <span class="errorMessage">All input Field must Fill.</span>
    </div>

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
          <div class="step current">
            <span>1</span>
            <label>Personal Infomation</label>
          </div>
          <div class="step">
            <span>2</span>
            <label>Address</label>
          </div>
          <div class="step">
            <span>3</span>
            <label>Email & Password</label>
          </div>
        </div>
    </div>

    <div class="right-content">
        <div class="form-header">
            <p>Step 1 of 3</p>
            <h2>Tell us who you are</h2>
        </div>

        <!-- <form action="../../backend/registration_process.php" method="POST"> -->
        <form action="{{ route('register.step1') }}" method="POST">
            @csrf

            <div class="field">
                <label>Given Name</label>
                <div class="inputField">
                    <input type="text" name="given_name" placeholder="Juan" required>
                </div>
            </div>

            <div class="pamilyName">
                <div class="field">
                    <label>Middle Name</label>
                    <div class="inputField">
                        <input type="text" name="middle_name" placeholder="Dela Cruz (Optional)">
                    </div>
                </div>

                <div class="field">
                    <label>Last Name</label>
                    <div class="inputField">
                        <input type="text" name="last_name" placeholder="Santos" required>
                    </div>
                </div>
            </div>

            <div class="personalAdditional">
                <div class="field">
                    <label>Suffix</label>
                    <div class="inputField">
                        <input type="text" name="suffix" placeholder="Jr. / Sr.">
                    </div>
                </div>

                <div class="field">
                    <label>Gender</label>
                    <div class="inputField">
                        <select name="gender" required>
                            <option value="" disabled selected>Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="buttons" name="register">
                <span>Next Step</span>
                <span class="btn-arrow">→</span>
            </button>
        </form>

        <div class="divider"><a href="{{ route('login') }}"><span>Already registered?</span> Login</a></div>

        <p class="form-footer">
            By continuing, you agree to eMASID's
            <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.
            Your data is used solely to improve community services.
        </p>
    </div>
</body>
</html>