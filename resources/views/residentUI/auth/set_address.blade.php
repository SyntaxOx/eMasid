<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../assets/logo/eMASID.png">
    <title>eMASID - Registration</title>
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

        .right-content .adr {
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
            gap: 13px;
            background-color: white;
            border-radius: 5px;
            padding: 15px 20px;
            font-size: 15px;
        }

        .right-content .inputField input {
            font-family: 'Nunito Sans', sans-serif;
            border: none;
            width: 100%;
            outline: none;
            user-select: auto;
            font-size: 15px;
        }

        .right-content .document {
            display: flex;
            flex-direction: column;
            gap: 25px;
            justify-content: center;
            font-family: 'Nunito Sans', sans-serif;
        }

        .right-content .inputField select {
            font-family: 'Nunito Sans', sans-serif;
            border: none;
            width: 100%;
            outline: none;
            user-select: auto;
            font-size: 15px;
        }

        .right-content .upload-zone {
            position: relative;
            border: 2px dashed #b8d8c4;
            border-radius: 10px;
            padding: 26px 20px;
            text-align: center;
            cursor: pointer;
            margin-bottom: 13px;
            transition: all 0.25s ease;
        }

        .right-content .upload-zone:hover,
        .right-content .upload-zone.dragover {
            border-color: #1f7a43;
            background: #f0f9f3;
        }

        .right-content .upload-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
            background-color: red;
        }

        .right-content .upload-title, .right-content .upload-icon {
            font-size: 18px;
            font-weight: 700;
            color: #16522e;
            margin-bottom: 4px;
        }

        .right-content .upload-title span {
            color: #1f7a43;
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .right-content .upload-sub {
            font-family: 'Nunito Sans', sans-serif;
            font-size: 15px;
            color: #7aab8a;
            letter-spacing: 0.3px;
        }

        .right-content .upload-types {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        .right-content .type-chip {
            font-family: 'Nunito Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: #1f7a43;
            background: #e4f2e9;
            border-radius: 20px;
            padding: 3px 10px;
        }

        .right-content .actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
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
            font-size: 18px;
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
    <div class="left-content">
        <div class="semi-container">
          <div class="dot-grid"></div>
          <div class="ring-extra"></div>

            <div class="icon">
                <img src="../../assets/logo/eMASID.png" alt="eMASID" class="eMASID-icon">
            </div>

          <h1 class="title">e<span>MASID</span></h1>
          <p class="tagline">Address Registration</p>

          <p class="description">Empowering Filipino communities to report, track, and resolve local issues — transparently and collectively.</p>
        </div>

        <div class="steps-container">
          <div class="step">
            <span>✓</span>
            <label>Personal Infomation</label>
          </div>
          <div class="step current">
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
            <p>Step 2 of 3</p>
            <h2>Address & Proof of Residency</h2>
        </div>

        <form action="{{ route('register.step2') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="adr">
                <div class="field">
                    <label for="region">Region</label>
                    <div class="inputField">
                        <i class="fa-solid fa-map cs-icon"></i>
                        <select name="region" id="">
                            <option value="" disabled selected>Region</option>
                            <option value="NCR">NCR</option>
                            <option value="Calabarzon">CALABARZON</option>
                        </select>
                    </div>
                </div>                
                <div class="field">
                    <label for="province">Province</label>
                    <div class="inputField">
                        <i class="fa-solid fa-building-columns cs-icon"></i>
                        <select name="province" id="">
                            <option value="" disabled selected>Province</option>
                            <option value="Metro Manila">Metro Manila</option>
                            <option value="Rizal">Rizal</option>
                        </select>
                    </div>
                </div>                
            </div>
            <div class="adr">
                <div class="field">
                    <label for="city">City / Municipality</label>
                    <div class="inputField">
                        <i class="fa-solid fa-city cs-icon"></i>
                        <select name="city" id="">
                            <option value="" disabled selected>Municipality</option>
                            <option value="Manila">Manila</option>
                            <option value="City Of Antipolo">City of Antipolo</option>
                        </select>
                    </div>
                </div>                
                <div class="field">
                    <label for="barangay">Barangay</label>
                    <div class="inputField">
                        <i class="fa-solid fa-location-dot cs-icon"></i>
                        <select name="barangay" id="">
                            <option value="" disabled selected>Barangay</option>
                            <option value="Katarungan">Katarungan</option>
                            <option value="San Luis">San Luis</option>
                        </select>
                    </div>
                </div>                
            </div>
            <div class="adr">
                <div class="field">
                    <label for="address">Complete Address</label>
                    <div class="inputField">
                        <i class="fa-solid fa-house"></i>
                        <input type="text" name="address" required placeholder="Lot 3 Block 6, Gatchilian Street, Brgy. Magtangol, Manila, Metro Manila 1000">
                    </div>
                </div>              
                <div class="field">
                    <label for="zipcode">Zip Code</label>
                    <div class="inputField">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" name="zipcode" required placeholder="1870">
                    </div>
                </div>                
            </div>

            <div class="document">
                <div class="field">
                    <label for="street">Document Type</label>
                    <div class="inputField">
                        <i class="fa-solid fa-folder"></i>
                        <select id="proof_type" name="proof_type" required>
                            <option value="" disabled selected>Select document type…</option>
                            <option value="barangay_cert">Barangay Certificate of Residency</option>
                            <option value="utility_bill">Utility Bill (Meralco / MAYNILAD / etc.)</option>
                            <option value="voters_id">Voter's ID / Voter's Certification</option>
                            <option value="postal_id">Postal ID</option>
                            <option value="bank_statement">Bank Statement (with address)</option>
                            <option value="lease_contract">Lease / Rental Contract</option>
                            <option value="other">Other Government-Issued Document</option>
                        </select>
                    </div>
                </div>

                <div class="upload-zone" id="uploadZone">
                    <input type="file" id="proofUpload" name="proof_files[]" accept=".jpg,.jpeg,.png,.pdf" multiple required>
                    <div class="upload-icon"><i class="fa-solid fa-upload"></i></div>
                    <p class="upload-title"><span>Click to upload</span> or drag & drop</p>
                    <p class="upload-sub">Clear, readable photos or scanned copies only</p>
                    <div class="upload-types">
                        <span class="type-chip">JPG</span>
                        <span class="type-chip">PNG</span>
                        <span class="type-chip">PDF</span>
                        <span class="type-chip">Max 5 MB each</span>
                    </div>
                </div>
            </div>

            <div class="actions">
              <button class="buttons-back" id="back-btn" name="back-btn">
                <span class="btn-arrow">←</span>
                <span>Back</span>
              </button>
              <button class="buttons" id="next-btn" name="set_address">
                  <span>Next Step</span>
                  <span class="btn-arrow">→</span>
              </button>
            </div>
        </form>
    </div>
</body>
</html>