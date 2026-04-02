<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <title>Barangay Reports</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Merriweather:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        :root {
            --bg-sand: #f8f6f0;
            --card-white: #ffffff;
            --text-dark: #2c2825;
            --text-soft: #5c554d;
            --text-muted: #8f887f;
            --accent-green: #2b6e4f;
            --accent-earth: #bc6c25;
            --accent-soft: #fef5e8;
            --border-light: #e2dbcf;
            --border-medium: #cfc6b8;
            --radius-md: 18px;
            --radius-sm: 12px;
            --shadow-card: 0 6px 18px rgba(0, 0, 0, 0.03), 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-float: 0 12px 28px -8px rgba(0, 0, 0, 0.12);
            --font-sans: 'Inter', system-ui, -apple-system, sans-serif;
            --font-serif: 'Merriweather', Georgia, serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-sand);
            font-family: var(--font-sans);
            color: var(--text-dark);
            line-height: 1.45;
        }

        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            background-image: radial-gradient(rgba(0, 0, 0, 0.02) 1px, transparent 1px);
            background-size: 20px 20px;
            z-index: 0;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 20px 24px 48px;
            position: relative;
            z-index: 2;
        }

        .village-header {
            margin-bottom: 28px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-end;
            border-bottom: 2px solid var(--border-light);
            padding-bottom: 14px;
        }

        .title-section h1 {
            font-family: var(--font-serif);
            font-size: 1.9rem;
            font-weight: 700;
            letter-spacing: -0.3px;
            color: var(--accent-green);
            line-height: 1.2;
        }

        .title-section p {
            font-size: 0.85rem;
            color: var(--text-soft);
            margin-top: 6px;
        }

        .badge-local {
            background: #e9e2d6;
            border-radius: 60px;
            padding: 6px 14px;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--accent-earth);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .report-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 26px;
        }

        .card-panel {
            background: var(--card-white);
            border-radius: var(--radius-md);
            border: 1px solid var(--border-light);
            box-shadow: var(--shadow-card);
            margin-bottom: 26px;
            transition: box-shadow 0.2s;
        }

        .card-panel:hover {
            box-shadow: var(--shadow-float);
        }

        .card-head {
            padding: 16px 22px;
            background: #fefcf7;
            border-bottom: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-head svg {
            width: 20px;
            height: 20px;
            stroke: var(--accent-earth);
            stroke-width: 1.7;
        }

        .card-head h2 {
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--text-soft);
        }

        .card-body {
            padding: 20px 22px;
        }

        .form-field {
            margin-bottom: 22px;
        }

        .form-field label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-soft);
            margin-bottom: 6px;
        }

        .form-field input,
        .form-field textarea,
        .form-field select {
            width: 100%;
            padding: 12px 14px;
            background: white;
            border: 1.5px solid var(--border-light);
            border-radius: var(--radius-sm);
            font-family: var(--font-sans);
            font-size: 0.9rem;
            transition: 0.15s;
            color: var(--text-dark);
        }

        .form-field input:focus,
        .form-field textarea:focus {
            outline: none;
            border-color: var(--accent-green);
            box-shadow: 0 0 0 3px rgba(43, 110, 79, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 95px;
        }

        .char-count {
            text-align: right;
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-top: 5px;
        }

        .error-msg {
            font-size: 0.7rem;
            color: #c25a2c;
            margin-top: 5px;
            display: none;
            font-weight: 500;
        }

        .error-msg.show {
            display: block;
        }

        .issue-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(115px, 1fr));
            gap: 10px;
            margin-bottom: 12px;
        }

        .type-pill {
            background: white;
            border: 1.5px solid var(--border-light);
            border-radius: 100px;
            padding: 8px 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.15s;
            color: var(--text-soft);
        }

        .type-pill svg {
            width: 17px;
            height: 17px;
            stroke: currentColor;
        }

        .type-pill.selected {
            background: #eaf4ef;
            border-color: var(--accent-green);
            color: var(--accent-green);
        }

        .type-pill input {
            display: none;
        }

        #other-text-field {
            margin-top: 10px;
            display: none;
        }

        .map-address-box {
            margin-bottom: 10px;
        }

        #report-map {
            height: 270px;
            width: 100%;
            border-radius: var(--radius-sm) var(--radius-sm) 0 0;
            z-index: 1;
        }

        .map-note {
            background: #fcf9f4;
            padding: 8px 15px;
            font-size: 0.7rem;
            border-bottom: 1px solid var(--border-light);
            display: flex;
            gap: 8px;
            color: var(--text-muted);
        }

        .address-display {
            background: var(--bg-sand);
            padding: 16px;
            border-radius: 0 0 var(--radius-sm) var(--radius-sm);
            border-top: 1px solid var(--border-light);
        }

        .address-meta {
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .address-icon {
            margin-top: 2px;
        }

        .address-text {
            flex: 1;
        }

        .address-street {
            font-weight: 600;
            font-size: 0.85rem;
        }

        .address-coord {
            font-size: 0.7rem;
            color: var(--text-muted);
            font-family: monospace;
            margin-top: 2px;
        }

        .source-badge {
            display: inline-block;
            background: #e2dcd0;
            border-radius: 50px;
            padding: 2px 8px;
            font-size: 0.65rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .photo-actions {
            display: flex;
            gap: 12px;
            margin-bottom: 18px;
            flex-wrap: wrap;
        }

        .cam-trigger {
            background: var(--accent-green);
            border: none;
            color: white;
            padding: 10px 18px;
            border-radius: 50px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .upload-zone {
            border: 2px dashed var(--border-medium);
            background: #fefaf2;
            border-radius: var(--radius-sm);
            padding: 18px;
            text-align: center;
            cursor: pointer;
            transition: 0.1s;
        }

        .upload-zone.drag-over {
            background: #ecf3ea;
            border-color: var(--accent-green);
        }

        .thumb-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 14px;
        }

        .thumb-item {
            position: relative;
            width: 70px;
            height: 70px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid var(--border-light);
        }

        .thumb-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .remove-photo {
            position: absolute;
            top: -6px;
            right: -6px;
            background: var(--accent-earth);
            color: white;
            border: none;
            width: 22px;
            height: 22px;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
        }

        .action-bar {
            grid-column: span 2;
            display: flex;
            justify-content: flex-end;
            gap: 16px;
            margin-top: 20px;
        }

        .btn-clear {
            background: transparent;
            border: 1.5px solid var(--border-medium);
            padding: 11px 26px;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-submit {
            background: var(--accent-earth);
            border: none;
            padding: 11px 34px;
            border-radius: 40px;
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
            display: inline-flex;
            gap: 8px;
            align-items: center;
            cursor: pointer;
        }

        .camera-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.92);
            z-index: 3000;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .camera-modal.open {
            display: flex;
        }

        .cam-box {
            background: #111;
            border-radius: 28px;
            max-width: 95%;
            width: 540px;
            overflow: hidden;
            position: relative;
        }

        #camera-feed {
            width: 100%;
            display: block;
            max-height: 70vh;
            background: black;
        }

        .cam-controls {
            position: absolute;
            bottom: 18px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 28px;
            background: linear-gradient(transparent, #000000aa);
            padding: 18px;
        }

        .shutter-btn {
            background: white;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            border: 3px solid #ddd;
        }

        .success-popup {
            position: fixed;
            inset: 0;
            background: rgba(44, 40, 37, 0.7);
            backdrop-filter: blur(4px);
            z-index: 4000;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .success-card {
            background: white;
            max-width: 380px;
            padding: 34px 28px;
            border-radius: 32px;
            text-align: center;
        }

        .toast-msg {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(80px);
            background: #2c2825;
            color: white;
            padding: 8px 20px;
            border-radius: 60px;
            font-size: 0.8rem;
            transition: 0.25s;
            z-index: 2500;
            pointer-events: none;
        }

        .toast-msg.show {
            transform: translateX(-50%) translateY(0);
        }

        @media (max-width: 780px) {
            .report-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .action-bar {
                grid-column: span 1;
            }

            .container {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="village-header">
            <div class="title-section">
                <h1>Barangay <span style="font-weight:400;">Mabuhay</span> · Isyung Bayan</h1>
                <p>Mabilis na pagtugon sa inyong mga hinaing — i-report ang mga suliranin sa inyong komunidad</p>
            </div>
            <div class="badge-local">
                <span>📍</span> <span>Brgy. Hall Assistance</span>
            </div>
        </div>

        <div class="report-grid">
            <!-- LEFT COLUMN: issue type & details -->
            <div class="left-side">
                <!-- card: issue type -->
                <div class="card-panel">
                    <div class="card-head">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 8v4M12 16h.01" />
                        </svg>
                        <h2>Uri ng Suliranin <span style="color:#bc6c25;">*</span></h2>
                    </div>
                    <div class="card-body">
                        <div class="issue-grid" id="issueTypeContainer">
                            <!-- options injected manually but via JS? Actually static with data binding -->
                        </div>
                        <div id="other-text-field" class="form-field">
                            <label>Iba pang isyu (pakisaad)</label>
                            <input type="text" id="otherIssueInput" placeholder="hal. ingay ng kapitbahay, stray animals..." maxlength="80">
                            <div class="error-msg" id="otherError">Kailangang punan ang ibang uri ng isyu.</div>
                        </div>
                        <div class="error-msg" id="issueTypeError">Pumili ng uri ng suliranin.</div>
                    </div>
                </div>

                <!-- card: report details -->
                <div class="card-panel">
                    <div class="card-head">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <h2>Impormasyon ng Nag-uulat</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-field">
                            <label>Pamagat ng Ulat *</label>
                            <input type="text" id="reportTitle" placeholder="Hal: Malaking hukay sa kalsada">
                            <div class="char-count"><span id="titleCount">0</span> / 80</div>
                            <div class="error-msg" id="titleError">Kailangan ng pamagat.</div>
                        </div>
                        <div class="form-field">
                            <label>Pangalan ng Nag-ulat *</label>
                            <input type="text" id="reporterName" placeholder="Buong pangalan">
                            <div class="error-msg" id="nameError">Ilagay ang iyong pangalan.</div>
                        </div>
                        <div class="form-field">
                            <label>Detalyadong Paglalarawan *</label>
                            <textarea id="issueDesc" placeholder="Ilarawan ang sitwasyon, kailan ito nagsimula, at paano ito nakakaapekto sa komunidad..."></textarea>
                            <div class="char-count"><span id="descCount">0</span> / 500</div>
                            <div class="error-msg" id="descError">Kinakailangan ang deskripsyon.</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: map & photos -->
            <div class="right-side">
                <!-- map card -->
                <div class="card-panel">
                    <div class="card-head">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        <h2>Lokasyon ng Insidente *</h2>
                    </div>
                    <div class="map-address-box">
                        <div id="report-map" style="height: 260px;"></div>
                        <div class="map-note">
                            <span>📍</span> I-click ang mapa para maglagay ng marker — i-drag para ayusin ang pwesto
                        </div>
                        <div class="address-display" id="addressDisplayBox">
                            <div class="address-meta">
                                <div class="address-icon">📍</div>
                                <div class="address-text">
                                    <div class="source-badge" id="locationSourceTag">Wala pang pinili</div>
                                    <div class="address-street" id="streetAddress">Pumili ng lokasyon sa mapa</div>
                                    <div class="address-coord" id="coordText">---</div>
                                </div>
                            </div>
                        </div>
                        <div class="error-msg" id="locationError">Kailangang pumili ng lokasyon sa mapa.</div>
                    </div>
                </div>

                <!-- photo evidence -->
                <div class="card-panel">
                    <div class="card-head">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <rect x="2" y="5" width="20" height="14" rx="2" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <h2>Larawan (opsyonal pero nakakatulong)</h2>
                    </div>
                    <div class="card-body">
                        <div class="photo-actions">
                            <button class="cam-trigger" id="openCameraBtn">📸 Kumuha ng Litrato</button>
                        </div>
                        <div class="upload-zone" id="dragDropZone">
                            <div>📁 I-drag & drop o i-click para mag-upload ng larawan</div>
                            <input type="file" id="fileUploader" accept="image/*" multiple hidden>
                            <div style="font-size:12px; margin-top:6px;">JPG, PNG, WEBP</div>
                        </div>
                        <div class="thumb-grid" id="photoThumbContainer"></div>
                        <div style="font-size:12px; margin-top:8px; color:#8f887f;" id="photoHintMsg">Walang nakalakip na larawan — maaaring magdagdag para mas mabilis ang aksyon.</div>
                    </div>
                </div>
            </div>

            <div class="action-bar">
                <button class="btn-clear" id="resetFormBtn">⟳ I-clear ang Form</button>
                <button class="btn-submit" id="submitReportBtn">📨 Isumite ang Ulat</button>
            </div>
        </div>
    </div>

    <!-- camera modal -->
    <div class="camera-modal" id="cameraModal">
        <div class="cam-box">
            <video id="cameraFeed" autoplay playsinline muted></video>
            <canvas id="photoCanvas" style="display:none;"></canvas>
            <div class="cam-controls">
                <button id="flipCameraBtn" style="background:#333; border:none; border-radius:40px; padding:8px 14px; color:white;">🔄 Flip</button>
                <button id="takePhotoBtn" class="shutter-btn" style="background:white; border:2px solid #ddd;"></button>
                <button id="closeCameraBtn" style="background:#333; border:none; border-radius:40px; padding:8px 14px; color:white;">✖ Isara</button>
            </div>
        </div>
    </div>

    <!-- success modal -->
    <div class="success-popup" id="successModal">
        <div class="success-card">
            <div style="background: #2b6e4f; width: 54px; height: 54px; margin: 0 auto 12px; border-radius: 60px; display: flex; align-items: center; justify-content: center;">
                <span style="color:white; font-size:28px;">✓</span>
            </div>
            <h3 style="font-size: 1.6rem;">Nai-report na!</h3>
            <p style="margin: 12px 0;">Natanggap na ng Barangay Hall ang inyong ulat. Seryosong aaksyunan ito.</p>
            <div style="background:#f4efe7; border-radius:50px; padding:6px 12px; margin: 16px 0; font-size:0.8rem;" id="refNumberDisplay">Ref: BRG-XXXXXX</div>
            <button id="newReportBtn" style="background: #bc6c25; border: none; padding: 10px 20px; border-radius: 40px; color: white; font-weight: bold;">➕ Gumawa ng Bagong Ulat</button>
        </div>
    </div>

    <div class="toast-msg" id="globalToast"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // JavaScript code for handling form interactions, map, camera, and submission logic goes here.
    </script>
</body>

</html>