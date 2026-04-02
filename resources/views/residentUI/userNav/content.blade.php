<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300..800;1,9..40,300..800&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
    /* ─── RESET ───────────────────────────────────────────────────── */
    *, *::before, *::after {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* ─── VARIABLES ───────────────────────────────────────────────── */
    :root {
        --green:       #0f7b5c;
        --green-light: #e6f7f1;
        --green-glow:  rgba(15, 123, 92, 0.18);
        --green-mid:   #1a9e76;
        --red:         #e04040;
        --blue:        #2563eb;
        --amber:       #d97706;
        --purple:      #7c3aed;
        --ink:         #111827;
        --ink-2:       #374151;
        --ink-3:       #9ca3af;
        --line:        #e5e7eb;
        --bg:          #f8faf9;
        --card:        #ffffff;
        --nav-h:       80px;
        --radius:      16px;
        --shadow:      0 4px 12px rgba(0, 0, 0, 0.1);
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: 'DM Sans', sans-serif;
        background-color: var(--bg);
        background-image: radial-gradient(circle, #d1d5db 1px, transparent 1px);
        background-size: 28px 28px;
        color: var(--ink);
        min-height: 100vh;
    }

    img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* ─── MAIN LAYOUT ─────────────────────────────────────────────── */

    main {
        max-width: 1180px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 22px;
        align-items: start;
    }


    /* ─── LEFT COLUMN ─────────────────────────────────────────────── */

    .left {
        display: flex;
        flex-direction: column;
        gap: 18px;
        padding: 20px 0;
    }


    /* ─── FILTER BAR ──────────────────────────────────────────────── */

    .filterbar {
        display: flex;
        align-items: center;
        gap: 10px;
        background: var(--card);
        border-radius: var(--radius);
        padding: 12px 14px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 0 0 1px rgba(0, 0, 0, 0.04);
    }

    .search-wrap {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 9px;
        background: var(--bg);
        border: 1.5px solid var(--line);
        border-radius: 10px;
        padding: 9px 13px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .search-wrap:focus-within {
        border-color: var(--green);
        box-shadow: 0 0 0 3px var(--green-glow);
    }

    .search-wrap i {
        color: var(--ink-3);
        font-size: 13px;
    }

    .search-wrap input {
        border: none;
        background: transparent;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        color: var(--ink);
        flex: 1;
        outline: none;
    }

    .search-wrap input::placeholder {
        color: var(--ink-3);
    }

    .filter-select-wrap {
        position: relative;
    }

    .filter-select-wrap::after {
        content: '▾';
        position: absolute;
        right: 11px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        font-size: 11px;
        color: var(--ink-3);
    }

    .filter-select-wrap select {
        appearance: none;
        background: var(--bg);
        border: 1.5px solid var(--line);
        border-radius: 10px;
        padding: 9px 30px 9px 12px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: var(--ink-2);
        cursor: pointer;
        outline: none;
        transition: border-color 0.2s;
        width: 140px;
    }

    .filter-select-wrap select:focus {
        border-color: var(--green);
    }

    /* Toggle */
    .toggle-wrap {
        display: flex;
        align-items: center;
        background: var(--bg);
        border: 1.5px solid var(--line);
        border-radius: 10px;
        padding: 3px;
        gap: 2px;
    }

    .toggle-btn {
        border: none;
        background: transparent;
        border-radius: 7px;
        padding: 6px 13px;
        font-family: 'DM Sans', sans-serif;
        font-size: 12px;
        font-weight: 700;
        color: var(--ink-3);
        cursor: pointer;
        transition: all 0.2s;
        letter-spacing: 0.3px;
    }

    .toggle-btn.active {
        background: var(--green);
        color: #fff;
        box-shadow: 0 2px 8px var(--green-glow);
    }


    /* ─── POST CARDS ──────────────────────────────────────────────── */

    .posts {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .card {
        background: var(--card);
        border-radius: var(--radius);
        overflow: hidden;
        border: 1px solid var(--line);
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.22s, transform 0.22s;
        animation: fadeUp 0.4s ease both;
    }

    .card:hover {
        box-shadow: 0 6px 28px rgba(0, 0, 0, 0.09);
        transform: translateY(-2px);
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(14px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card:nth-child(1) { animation-delay: 0.05s; }
    .card:nth-child(2) { animation-delay: 0.12s; }
    .card:nth-child(3) { animation-delay: 0.18s; }
    .card:nth-child(4) { animation-delay: 0.24s; }
    .card:nth-child(5) { animation-delay: 0.30s; }

    /* Card header */
    .card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 18px 12px;
        border-bottom: 1px solid var(--line);
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .user-dp {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid var(--green-light);
        flex-shrink: 0;
    }

    .user-dp img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .user-name {
        font-weight: 700;
        font-size: 14px;
        margin-bottom: 2px;
    }

    .user-meta {
        font-size: 11px;
        color: var(--ink-3);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .badges {
        display: flex;
        gap: 6px;
        align-items: center;
    }

    .badge {
        border-radius: 20px;
        padding: 4px 11px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    /* Status badges */
    .badge-open    { background: #dcfce7; color: #16a34a; border: 1px solid #bbf7d0; }
    .badge-closed  { background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }
    .badge-pending { background: #fef9c3; color: #ca8a04; border: 1px solid #fde68a; }

    /* Category badges */
    .badge-road    { background: #fee2e2; color: var(--red);    border: 1px solid #fecaca; }
    .badge-flood   { background: #dbeafe; color: var(--blue);   border: 1px solid #bfdbfe; }
    .badge-light   { background: #fef3c7; color: var(--amber);  border: 1px solid #fde68a; }
    .badge-garbage { background: #d1fae5; color: var(--green);  border: 1px solid #a7f3d0; }
    .badge-infra   { background: #ede9fe; color: var(--purple); border: 1px solid #ddd6fe; }

    /* Card body */
    .card-body {
        padding: 14px 18px;
    }

    .card-body h2 {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 7px;
        color: var(--ink);
        line-height: 1.4;
    }

    .card-body p {
        font-size: 13.5px;
        line-height: 1.75;
        color: var(--ink-2);
    }

    /* Photo grid */
    .photo-grid {
        display: grid;
        gap: 3px;
        border-radius: 10px;
        overflow: hidden;
        margin-top: 13px;
    }

    .photo-grid img {
        width: 100%;
        object-fit: cover;
        display: block;
        cursor: zoom-in;
        transition: transform 0.25s ease, filter 0.25s;
    }

    .photo-grid img:hover {
        /* transform: scale(1.04); */
        filter: brightness(0.5);
    }

    .pg-1 { grid-template-columns: 1fr; }
    .pg-1 img { height: 240px; }

    .pg-2 { grid-template-columns: 1fr 1fr; }
    .pg-2 img { height: 185px; }

    .pg-3 { grid-template-columns: 1fr 1fr; grid-template-rows: 120px 120px; }
    .pg-3 img:first-child { grid-row: span 2; height: 100%; }
    .pg-3 img:not(:first-child) { height: 120px; }

    .pg-4 { grid-template-columns: 1fr 1fr; }
    .pg-4 img { height: 140px; }

    .pg-5-top {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3px;
    }

    .pg-5-bottom {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 3px;
    }

    .pg-5-top img    { height: 155px; }
    .pg-5-bottom img { height: 125px; }

    /* Card actions */
    .card-actions {
        display: flex;
        border-top: 1px solid var(--line);
        background: #fafafa;
    }

    .act-btn {
        flex: 1;
        border: none;
        background: transparent;
        padding: 12px 0;
        font-family: 'DM Sans', sans-serif;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.3px;
        color: var(--ink-3);
        cursor: pointer;
        transition: all 0.18s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        position: relative;
    }

    .act-btn + .act-btn::before {
        content: '';
        position: absolute;
        left: 0;
        top: 20%;
        bottom: 20%;
        width: 1px;
        background: var(--line);
    }

    .act-btn:hover {
        background: var(--green-light);
        color: var(--green);
    }

    .act-btn.flag-btn:hover {
        background: #fee2e2;
        color: var(--red);
    }

    .act-btn.voted {
        color: var(--green);
        background: var(--green-light);
        pointer-events: none;
    }

    .act-btn.voted .vote-icon {
        animation: pop 0.3s ease;
    }

    @keyframes pop {
        0%   { transform: scale(1); }
        50%  { transform: scale(1.5); }
        100% { transform: scale(1); }
    }

    .vote-pill {
        background: var(--green);
        color: #fff;
        border-radius: 20px;
        padding: 1px 8px;
        font-size: 11px;
    }

    .act-btn.voted .vote-pill {
        background: var(--green);
    }


    /* ─── RIGHT COLUMN ────────────────────────────────────────────── */

    .right {
        display: flex;
        flex-direction: column;
        gap: 16px;
        position: sticky;
        padding: 20px 0;
        top: var(--nav-h);
    }


    /* ─── MAP CARD ────────────────────────────────────────────────── */

    .map-card {
        border-radius: var(--radius);
        overflow: hidden;
        border: 1px solid var(--line);
        box-shadow: 0 4px 20px rgba(15, 123, 92, 0.12);
        animation: fadeUp 0.3s ease both;
    }

    .map-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 13px 16px;
        background: linear-gradient(135deg, #0f7b5c 0%, #0a5c44 100%);
        color: #fff;
    }

    .map-head-left {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .map-head-title {
        font-size: 13px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .map-head-sub {
        font-size: 10px;
        color: rgba(255, 255, 255, 0.5);
        letter-spacing: 0.8px;
        text-transform: uppercase;
    }

    .map-pill {
        background: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.3px;
    }

    #main-map {
        width: 100%;
        height: 260px;
    }


    /* ─── EMERGENCY CONTACTS ──────────────────────────────────────── */

    .contacts-card {
        background: var(--card);
        border-radius: var(--radius);
        overflow: hidden;
        border: 1px solid var(--line);
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        animation: fadeUp 0.4s 0.1s ease both;
    }

    .contacts-head {
        padding: 13px 18px;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 0.4px;
        background: #fafafa;
        border-bottom: 1px solid var(--line);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .contacts-head i {
        color: var(--red);
    }

    .contact-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 11px 18px;
        border-bottom: 1px solid #f3f4f6;
        transition: background 0.15s;
        cursor: default;
    }

    .contact-item:last-of-type {
        border-bottom: none;
    }

    .contact-item:hover {
        background: #f8fffe;
    }

    .contact-left {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .contact-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: grid;
        place-items: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .contact-icon.police  { background: #dbeafe; }
    .contact-icon.medical { background: #fee2e2; }
    .contact-icon.fire    { background: #ffedd5; }
    .contact-icon.power   { background: #fef9c3; }

    .contact-name {
        font-weight: 700;
        font-size: 13px;
        margin-bottom: 2px;
    }

    .contact-num {
        font-size: 11px;
        color: var(--ink-3);
    }

    .call-btn {
        border: 1px solid #bbf7d0;
        background: #dcfce7;
        color: #15803d;
        border-radius: 20px;
        padding: 5px 14px;
        font-size: 11px;
        font-weight: 800;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        letter-spacing: 0.3px;
        transition: all 0.18s;
    }

    .call-btn:hover {
        background: #bbf7d0;
    }

    .contacts-footer {
        text-align: center;
        padding: 9px;
        font-size: 10px;
        color: var(--ink-3);
        letter-spacing: 1px;
        text-transform: uppercase;
        background: #fafafa;
        border-top: 1px solid var(--line);
    }


    /* ─── REPORT AN ISSUE BUTTON ──────────────────────────────────── */

    .report-fab-inline {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: linear-gradient(135deg, #e04040 0%, #c41f1f 100%);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 13px 20px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 800;
        cursor: pointer;
        box-shadow: 0 4px 16px rgba(224, 64, 64, 0.35);
        transition: all 0.2s ease;
        letter-spacing: 0.3px;
    }

    .report-fab-inline:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(224, 64, 64, 0.45);
    }

    .report-fab-inline:active {
        transform: translateY(0);
    }

    .report-fab-inline .fab-icon {
        width: 22px;
        height: 22px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: grid;
        place-items: center;
        font-size: 14px;
        font-weight: 900;
    }


    /* ─── SCROLL TO TOP ───────────────────────────────────────────── */

    .scroll-top {
        position: fixed;
        bottom: 28px;
        right: 28px;
        z-index: 999;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: none;
        background: var(--green);
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        box-shadow: 0 4px 16px rgba(15, 123, 92, 0.4);
        display: grid;
        place-items: center;
        opacity: 0;
        transform: translateY(12px) scale(0.85);
        pointer-events: none;
        transition: opacity 0.25s ease, transform 0.25s ease, box-shadow 0.2s;
    }

    .scroll-top.visible {
        opacity: 1;
        transform: translateY(0) scale(1);
        pointer-events: auto;
    }

    .scroll-top:hover {
        box-shadow: 0 8px 24px rgba(15, 123, 92, 0.5);
        transform: translateY(-2px) scale(1.05);
    }


    /* ─── LIGHTBOX ────────────────────────────────────────────────── */

    .lightbox {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: rgba(0, 0, 0, 0.88);
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.2s ease;
    }

    .lightbox.open {
        display: flex;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    .lightbox img {
        max-width: 90vw;
        max-height: 88vh;
        border-radius: 10px;
        box-shadow: 0 8px 60px rgba(0, 0, 0, 0.6);
        animation: zoomIn 0.25s ease;
        width: auto;
        height: auto;
    }

    @keyframes zoomIn {
        from { transform: scale(0.9); opacity: 0; }
        to   { transform: scale(1);   opacity: 1; }
    }

    .lightbox-close {
        position: absolute;
        top: 20px;
        right: 24px;
        color: rgba(255, 255, 255, 0.7);
        font-size: 28px;
        cursor: pointer;
        line-height: 1;
        transition: color 0.15s;
    }

    .lightbox-close:hover {
        color: #fff;
    }


    /* ─── LEAFLET POPUP ───────────────────────────────────────────── */

    .leaflet-popup-content-wrapper {
        border-radius: 12px !important;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18) !important;
        padding: 0 !important;
        overflow: hidden;
        font-family: 'DM Sans', sans-serif !important;
    }

    .leaflet-popup-content {
        margin: 13px 15px !important;
    }

    .leaflet-popup-tip-container {
        display: none;
    }


    /* ─── RESPONSIVE ──────────────────────────────────────────────── */

    @media (max-width: 860px) {
        main {
            grid-template-columns: 1fr;
        }

        .right {
            position: static;
        }

        nav {
            grid-template-columns: 1fr 1fr;
            padding: 0 20px;
        }

        .userSearchContainer {
            display: none;
        }
    }
</style>

<!-- Lightbox overlay -->
<div class="lightbox" id="lightbox" onclick="closeLightbox()">
    <span class="lightbox-close">✕</span>
    <img id="lightbox-img" src="" alt="Photo">
</div>

<!-- Scroll to top button -->
<button class="scroll-top" id="scrollTop" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">
    <i class="fa-solid fa-arrow-up"></i>
</button>

<main>
    <!-- Left column -->
    <section class="left">

        <!-- Filter bar -->
        <div class="filterbar">
            <div class="search-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="postSearchInput" placeholder="Search reports…">
            </div>
            <div class="filter-select-wrap">
                <select id="statusFilter">
                    <option value="">All Status</option>
                    <option value="open">Open</option>
                    <option value="closed">Closed</option>
                    <option value="pending">Pending</option>
                </select>
            </div>
            <div class="toggle-wrap">
                <button class="toggle-btn active" id="btn-residents" onclick="setMode('residents')">Residents</button>
                <button class="toggle-btn" id="btn-officials" onclick="setMode('officials')">Officials</button>
            </div>
        </div>

        <!-- Posts feed -->
        <div class="posts" id="posts">


            <!-- Post 1 ─── Road / Open ──────────────────────────── -->
            <div class="card" data-status="open">
                <div class="card-head">
                    <div class="user-profile">
                        <div class="user-dp">
                            <img src="https://i.pravatar.cc/80?img=11" alt="Maria Santos">
                        </div>
                        <div>
                            <div class="user-name">Maria Santos</div>
                            <div class="user-meta">
                                <i class="fa-solid fa-location-dot" style="font-size: 10px;"></i>
                                San Luis, Antipolo · 2d ago
                            </div>
                        </div>
                    </div>
                    <div class="badges">
                        <span class="badge badge-open">Open</span>
                        <span class="badge badge-road">Road</span>
                    </div>
                </div>
                <div class="card-body">
                    <h2>Large Pothole on Circumferential Road</h2>
                    <p>
                        A large and dangerous pothole near the barangay hall junction has caused
                        two motorcycle accidents in two weeks. The hole is about 40 cm wide and
                        very deep, making it difficult for vehicles to avoid especially at night.
                    </p>
                    <div class="photo-grid pg-1">
                        <img src="https://images.unsplash.com/photo-1515162816999-a0c47dc192f7?w=800&q=80" alt="Pothole on road">
                    </div>
                </div>
                <div class="card-actions">
                    <button class="act-btn voted" onclick="handleVote(this)">
                        <span class="vote-icon">▲</span>
                        <span class="vote-pill">14</span>
                        Upvoted
                    </button>
                    <button class="act-btn" onclick="flyToPin(14.5880, 121.1750)">
                        <i class="fa-regular fa-map"></i> View on Map
                    </button>
                    <button class="act-btn flag-btn">
                        <i class="fa-regular fa-flag"></i> Report
                    </button>
                </div>
            </div>


            <!-- Post 2 ─── Flood / Open ─────────────────────────── -->
            <div class="card" data-status="open">
                <div class="card-head">
                    <div class="user-profile">
                        <div class="user-dp">
                            <img src="https://i.pravatar.cc/80?img=32" alt="Ramon Dela Cruz">
                        </div>
                        <div>
                            <div class="user-name">Ramon Dela Cruz</div>
                            <div class="user-meta">
                                <i class="fa-solid fa-location-dot" style="font-size: 10px;"></i>
                                San Luis, Antipolo · 5d ago
                            </div>
                        </div>
                    </div>
                    <div class="badges">
                        <span class="badge badge-open">Open</span>
                        <span class="badge badge-flood">Flood</span>
                    </div>
                </div>
                <div class="card-body">
                    <h2>Clogged Drainage Causing Street Flooding</h2>
                    <p>
                        The drainage canal beside the public market is completely clogged with debris.
                        Every heavy rain floods the street up to knee-level, affecting several households
                        and small businesses. Urgent clearing is needed before the wet season worsens.
                    </p>
                    <div class="photo-grid pg-2">
                        <img src="https://images.unsplash.com/photo-1547683905-f686c993aae5?w=600&q=80" alt="Flooded street">
                        <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=600&q=80" alt="Clogged drainage">
                    </div>
                </div>
                <div class="card-actions">
                    <button class="act-btn" onclick="handleVote(this)">
                        <span class="vote-icon">▲</span>
                        <span class="vote-pill" style="background: #9ca3af;">8</span>
                        Upvote
                    </button>
                    <button class="act-btn" onclick="flyToPin(14.5855, 121.1728)">
                        <i class="fa-regular fa-map"></i> View on Map
                    </button>
                    <button class="act-btn flag-btn">
                        <i class="fa-regular fa-flag"></i> Report
                    </button>
                </div>
            </div>


            <!-- Post 3 ─── Lighting / Pending ──────────────────── -->
            <div class="card" data-status="pending">
                <div class="card-head">
                    <div class="user-profile">
                        <div class="user-dp">
                            <img src="https://i.pravatar.cc/80?img=47" alt="Liza Reyes">
                        </div>
                        <div>
                            <div class="user-name">Liza Reyes</div>
                            <div class="user-meta">
                                <i class="fa-solid fa-location-dot" style="font-size: 10px;"></i>
                                San Luis, Antipolo · 1w ago
                            </div>
                        </div>
                    </div>
                    <div class="badges">
                        <span class="badge badge-pending">Pending</span>
                        <span class="badge badge-light">Lighting</span>
                    </div>
                </div>
                <div class="card-body">
                    <h2>Broken Street Lights Near Elementary School</h2>
                    <p>
                        Several street lights along San Luis Elementary School have been out for weeks.
                        Students going home after evening activities face a genuine safety risk due to
                        complete darkness along that stretch of road.
                    </p>
                    <div class="photo-grid pg-3">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80" alt="Broken light pole">
                        <img src="https://images.unsplash.com/photo-1534274988757-a28bf1a57c17?w=600&q=80" alt="Dark street">
                        <img src="https://images.unsplash.com/photo-1519003722824-194d4455a60c?w=600&q=80" alt="Street at night">
                    </div>
                </div>
                <div class="card-actions">
                    <button class="act-btn" onclick="handleVote(this)">
                        <span class="vote-icon">▲</span>
                        <span class="vote-pill" style="background: #9ca3af;">5</span>
                        Upvote
                    </button>
                    <button class="act-btn" onclick="flyToPin(14.5895, 121.1765)">
                        <i class="fa-regular fa-map"></i> View on Map
                    </button>
                    <button class="act-btn flag-btn">
                        <i class="fa-regular fa-flag"></i> Report
                    </button>
                </div>
            </div>


            <!-- Post 4 ─── Garbage / Open ───────────────────────── -->
            <div class="card" data-status="open">
                <div class="card-head">
                    <div class="user-profile">
                        <div class="user-dp">
                            <img src="https://i.pravatar.cc/80?img=58" alt="Carlo Mendoza">
                        </div>
                        <div>
                            <div class="user-name">Carlo Mendoza</div>
                            <div class="user-meta">
                                <i class="fa-solid fa-location-dot" style="font-size: 10px;"></i>
                                San Luis, Antipolo · 2w ago
                            </div>
                        </div>
                    </div>
                    <div class="badges">
                        <span class="badge badge-open">Open</span>
                        <span class="badge badge-garbage">Garbage</span>
                    </div>
                </div>
                <div class="card-body">
                    <h2>Overflowing Garbage Along Barangay Road</h2>
                    <p>
                        Uncollected waste has been piling up along the main barangay road for nearly
                        two weeks. Garbage overflows onto the sidewalk, creating foul odors and
                        attracting pests. Residents with young children are particularly concerned
                        about health hazards.
                    </p>
                    <div class="photo-grid pg-4">
                        <img src="https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=600&q=80" alt="Overflowing garbage bin">
                        <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=600&q=80" alt="Trash on sidewalk">
                        <img src="https://images.unsplash.com/photo-1604187351574-c75ca79f5807?w=600&q=80" alt="Garbage pile">
                        <img src="https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?w=600&q=80" alt="Street waste">
                    </div>
                </div>
                <div class="card-actions">
                    <button class="act-btn" onclick="handleVote(this)">
                        <span class="vote-icon">▲</span>
                        <span class="vote-pill" style="background: #9ca3af;">21</span>
                        Upvote
                    </button>
                    <button class="act-btn" onclick="flyToPin(14.5862, 121.1758)">
                        <i class="fa-regular fa-map"></i> View on Map
                    </button>
                    <button class="act-btn flag-btn">
                        <i class="fa-regular fa-flag"></i> Report
                    </button>
                </div>
            </div>


            <!-- Post 5 ─── Infrastructure / Resolved ────────────── -->
            <div class="card" data-status="closed">
                <div class="card-head">
                    <div class="user-profile">
                        <div class="user-dp">
                            <img src="https://i.pravatar.cc/80?img=25" alt="Ana Villanueva">
                        </div>
                        <div>
                            <div class="user-name">Ana Villanueva</div>
                            <div class="user-meta">
                                <i class="fa-solid fa-location-dot" style="font-size: 10px;"></i>
                                San Luis, Antipolo · 3w ago
                            </div>
                        </div>
                    </div>
                    <div class="badges">
                        <span class="badge badge-closed">Resolved</span>
                        <span class="badge badge-infra">Infrastructure</span>
                    </div>
                </div>
                <div class="card-body">
                    <h2>Collapsed Footbridge Over Creek</h2>
                    <p>
                        The wooden footbridge connecting two sitios over the creek partially collapsed
                        after heavy rains. This was the only passage for residents on the far side.
                        Elderly residents and schoolchildren were forced to wade through the creek
                        daily — now resolved by barangay.
                    </p>
                    <div class="photo-grid">
                        <div class="pg-5-top">
                            <img src="https://images.unsplash.com/photo-1508193638397-1c4234db14d8?w=800&q=80" alt="Bridge overview">
                            <img src="https://images.unsplash.com/photo-1541888946425-d81bb19240f5?w=600&q=80" alt="Structural damage">
                        </div>
                        <div style="height: 3px;"></div>
                        <div class="pg-5-bottom">
                            <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80" alt="Creek below bridge">
                            <img src="https://images.unsplash.com/photo-1581091870623-4f4d6b826a26?w=600&q=80" alt="People crossing creek">
                            <img src="https://images.unsplash.com/photo-1590674899484-d5640e854abe?w=600&q=80" alt="Damaged planks">
                        </div>
                    </div>
                </div>
                <div class="card-actions">
                    <button class="act-btn voted">
                        <span class="vote-icon">▲</span>
                        <span class="vote-pill">37</span>
                        Upvoted
                    </button>
                    <button class="act-btn" onclick="flyToPin(14.5910, 121.1738)">
                        <i class="fa-regular fa-map"></i> View on Map
                    </button>
                    <button class="act-btn flag-btn">
                        <i class="fa-regular fa-flag"></i> Report
                    </button>
                </div>
            </div>


        </div>
    </section>


    <!-- Right column -->
    <section class="right">

        <!-- Live map -->
        <div class="map-card">
            <div class="map-head">
                <div class="map-head-left">
                    <div class="map-head-title">
                        <i class="fa-solid fa-location-crosshairs"></i>
                        San Luis, Antipolo City
                    </div>
                    <div class="map-head-sub">Live Report Map</div>
                </div>
                <span class="map-pill" id="pin-count">5 pins</span>
            </div>
            <div id="main-map"></div>
        </div>

        <!-- Emergency contacts -->
        <div class="contacts-card">
            <div class="contacts-head">
                <i class="fa-solid fa-phone-volume"></i>
                Emergency Contacts
            </div>

            <div class="contact-item">
                <div class="contact-left">
                    <div class="contact-icon police">🚔</div>
                    <div>
                        <div class="contact-name">PNP Antipolo</div>
                        <div class="contact-num">(02) 8999-0000</div>
                    </div>
                </div>
                <button class="call-btn">Call</button>
            </div>

            <div class="contact-item">
                <div class="contact-left">
                    <div class="contact-icon medical">🚑</div>
                    <div>
                        <div class="contact-name">Antipolo City Hospital</div>
                        <div class="contact-num">(02) 8697-0301</div>
                    </div>
                </div>
                <button class="call-btn">Call</button>
            </div>

            <div class="contact-item">
                <div class="contact-left">
                    <div class="contact-icon fire">🚒</div>
                    <div>
                        <div class="contact-name">BFP Antipolo</div>
                        <div class="contact-num">(02) 8681-2626</div>
                    </div>
                </div>
                <button class="call-btn">Call</button>
            </div>

            <div class="contact-item">
                <div class="contact-left">
                    <div class="contact-icon power">⚡</div>
                    <div>
                        <div class="contact-name">MERALCO Hotline</div>
                        <div class="contact-num">16211</div>
                    </div>
                </div>
                <button class="call-btn">Call</button>
            </div>

            <div class="contacts-footer">eMASID · San Luis, Antipolo City</div>
        </div>

        <!-- Report an issue -->
        <button class="report-fab-inline">
            <span class="fab-icon">＋</span>
            Report an Issue
        </button>

    </section>
</main>

<script>
    // ── User profile dropdown ───────────────────────────────────────

    const userProfileBtn = document.getElementById('userProfileBtn');
    const userDropdown   = document.getElementById('userDropdown');

    userProfileBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        userDropdown.classList.toggle('active');
    });

    userDropdown.addEventListener('click', (e) => e.stopPropagation());

    const closeAllPopups = () => {
        userDropdown.classList.remove('active');
        searchResults.style.display = 'none';
    };

    document.addEventListener('click', closeAllPopups);

    window.addEventListener('scroll', () => {
        if (userDropdown.classList.contains('active') || searchResults.style.display === 'flex') {
            closeAllPopups();
        }
    });


    // ── Scroll to top ───────────────────────────────────────────────

    const scrollBtn = document.getElementById('scrollTop');

    window.addEventListener('scroll', () => {
        scrollBtn.classList.toggle('visible', window.scrollY > 300);
    });


    // ── Residents / Officials toggle ────────────────────────────────

    function setMode(mode) {
        document.getElementById('btn-residents').classList.toggle('active', mode === 'residents');
        document.getElementById('btn-officials').classList.toggle('active', mode === 'officials');
    }


    // ── Upvote ──────────────────────────────────────────────────────

    function handleVote(btn) {
        if (btn.classList.contains('voted')) return;

        const pill     = btn.querySelector('.vote-pill');
        const newCount = parseInt(pill.textContent) + 1;

        btn.classList.add('voted');
        btn.innerHTML = `
            <span class="vote-icon">▲</span>
            <span class="vote-pill">${newCount}</span>
            Upvoted
        `;
    }


    // ── Post search and status filter ───────────────────────────────

    const postSearchInput = document.getElementById('postSearchInput');
    const statusFilter    = document.getElementById('statusFilter');
    const cards           = document.querySelectorAll('.card');

    function filterCards() {
        const query  = postSearchInput.value.toLowerCase();
        const status = statusFilter.value.toLowerCase();

        cards.forEach(card => {
            const text       = card.innerText.toLowerCase();
            const cardStatus = card.dataset.status || '';
            const matches    = (!query || text.includes(query)) && (!status || cardStatus === status);

            card.style.display = matches ? '' : 'none';
        });
    }

    postSearchInput.addEventListener('input', filterCards);
    statusFilter.addEventListener('change', filterCards);


    // ── Lightbox ────────────────────────────────────────────────────

    document.querySelectorAll('.photo-grid img, .pg-5-top img, .pg-5-bottom img').forEach(img => {
        img.addEventListener('click', () => {
            document.getElementById('lightbox-img').src = img.src;
            document.getElementById('lightbox').classList.add('open');
        });
    });

    function closeLightbox() {
        document.getElementById('lightbox').classList.remove('open');
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });


    // ── Leaflet map setup ───────────────────────────────────────────

    const map = L.map('main-map', {
        center: [14.5873, 121.1745],
        zoom: 14,
        zoomControl: true,
        scrollWheelZoom: false,
    });

    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
        maxZoom: 19,
        attribution: '© OSM © CARTO'
    }).addTo(map);

    function pulseIcon(color) {
        return L.divIcon({
            className: '',
            html: `
                <div style="position: relative; width: 28px; height: 28px;">
                    <div style="
                        position: absolute;
                        inset: 0;
                        border-radius: 50%;
                        background: ${color};
                        opacity: 0.2;
                        animation: pr 2s ease-out infinite;
                    "></div>
                    <div style="
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        width: 15px;
                        height: 15px;
                        background: ${color};
                        border: 2.5px solid #fff;
                        border-radius: 50%;
                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
                    "></div>
                </div>
                <style>
                    @keyframes pr {
                        0%   { transform: scale(0.6); opacity: 0.4; }
                        70%  { transform: scale(2.4); opacity: 0; }
                        100% { transform: scale(2.4); opacity: 0; }
                    }
                </style>
            `,
            iconSize:    [28, 28],
            iconAnchor:  [14, 14],
            popupAnchor: [0, -18]
        });
    }

    const pins = [
        {
            lat: 14.5880, lng: 121.1750,
            title: 'Large Pothole on Circumferential Road',
            cat: 'Road',
            color: '#e04040'
        },
        {
            lat: 14.5855, lng: 121.1728,
            title: 'Clogged Drainage — Street Flooding',
            cat: 'Flood',
            color: '#2563eb'
        },
        {
            lat: 14.5895, lng: 121.1765,
            title: 'Broken Street Lights – Elementary School',
            cat: 'Lighting',
            color: '#d97706'
        },
        {
            lat: 14.5862, lng: 121.1758,
            title: 'Overflowing Garbage Along Barangay Road',
            cat: 'Garbage',
            color: '#0f7b5c'
        },
        {
            lat: 14.5910, lng: 121.1738,
            title: 'Collapsed Footbridge Over Creek',
            cat: 'Infrastructure',
            color: '#7c3aed'
        },
    ];

    const markers = {};

    pins.forEach((pin, index) => {
        const marker = L.marker([pin.lat, pin.lng], { icon: pulseIcon(pin.color) })
            .addTo(map)
            .bindPopup(`
                <div style="font-family: 'DM Sans', sans-serif; min-width: 170px; padding: 2px 0;">
                    <div style="
                        font-weight: 700;
                        font-size: 13px;
                        margin-bottom: 7px;
                        line-height: 1.4;
                        color: #111;
                    ">${pin.title}</div>
                    <span style="
                        display: inline-block;
                        font-size: 10px;
                        font-weight: 800;
                        background: ${pin.color}18;
                        color: ${pin.color};
                        padding: 3px 11px;
                        border-radius: 20px;
                        border: 1px solid ${pin.color}35;
                        letter-spacing: 0.5px;
                        text-transform: uppercase;
                    ">${pin.cat}</span>
                </div>
            `);

        markers[index] = marker;
    });

    document.getElementById('pin-count').textContent = pins.length + ' pins';


    // ── Fly to a pin when "View on Map" is clicked ──────────────────

    function flyToPin(lat, lng) {
        map.flyTo([lat, lng], 16, { animate: true, duration: 1 });

        pins.forEach((pin, index) => {
            if (pin.lat === lat && pin.lng === lng) {
                markers[index].openPopup();
            }
        });

        document.querySelector('.map-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
</script>