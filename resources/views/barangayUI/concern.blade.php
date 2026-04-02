<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Concerns | Administrative Ledger</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700;900&family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Nunito Sans', sans-serif;
            background: #faf9f4;
            color: #1b1c19;
        }

        :root {
            --forest: #0F3D2E;
            --forest-mid: #1a7a5e;
            --forest-bright: #22a07a;
            --forest-pale: #e6f5f0;
            --gold: #fdc425;
            --gold-soft: #fff8e1;
            --gold-dark: #7a5500;
            --red: #ba1a1a;
            --ink: #1b1c19;
            --ink-2: #414944;
            --ink-3: #717974;
            --line: #e0e4e0;
            --surface: #faf9f4;
            --card: #ffffff;
            --sidebar-width: 260px;
            --shadow: 0 2px 12px rgba(15, 61, 46, 0.08);
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: var(--forest);
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 28px 24px 22px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-brand-title {
            font-family: 'Noto Serif', serif;
            font-weight: 900;
            font-size: 1rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #fff;
        }

        .sidebar-brand-sub {
            font-size: 9.5px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.4);
            margin-top: 4px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 11px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.55);
            cursor: pointer;
            transition: all 0.18s;
            text-decoration: none;
        }

        .nav-item i {
            width: 18px;
            text-align: center;
            font-size: 14px;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.07);
            color: rgba(255, 255, 255, 0.85);
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            box-shadow: inset 3px 0 0 var(--gold);
        }

        .sidebar-footer {
            padding: 16px 14px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .logout-btn {
            width: 100%;
            padding: 11px;
            background: var(--gold);
            color: var(--gold-dark);
            border: none;
            border-radius: 10px;
            font-family: 'Noto Serif', serif;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.18s;
        }

        .logout-btn:hover {
            background: #ffe066;
        }

        .main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .page-header {
            background: var(--surface);
            border-bottom: 1px solid var(--line);
            padding: 28px 40px 0;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .header-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .header-title {
            font-family: 'Noto Serif', serif;
            font-size: 1.75rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--forest);
        }

        .header-desc {
            font-size: 13.5px;
            color: var(--ink-3);
            margin-top: 5px;
            font-weight: 500;
        }

        .search-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--card);
            border: 1.5px solid var(--line);
            border-radius: 50px;
            padding: 9px 18px;
            transition: border-color 0.2s;
        }

        .search-bar:focus-within {
            border-color: var(--forest-mid);
        }

        .search-bar i {
            color: var(--ink-3);
            font-size: 13px;
        }

        .search-bar input {
            border: none;
            background: none;
            font-size: 13px;
            width: 200px;
            color: var(--ink);
        }

        .search-bar input::placeholder {
            color: var(--ink-3);
        }

        .tab-bar {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 20px;
            padding-bottom: 0;
        }

        .tab-item {
            padding: 10px 20px;
            border-radius: 10px 10px 0 0;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            border: none;
            background: none;
            color: var(--ink-3);
            transition: all 0.18s;
            font-family: inherit;
            border-bottom: 2px solid transparent;
        }

        .tab-item .badge-count {
            display: inline-block;
            margin-left: 6px;
            background: var(--line);
            border-radius: 20px;
            padding: 1px 7px;
            font-size: 10px;
            color: var(--ink-3);
        }

        .tab-item:hover {
            color: var(--ink);
            background: var(--card);
        }

        .tab-item.active {
            color: var(--forest);
            border-bottom: 2px solid var(--forest);
            background: var(--card);
            font-weight: 800;
        }

        .tab-item.active .badge-count {
            background: var(--forest-pale);
            color: var(--forest);
        }

        .tab-divider {
            flex: 1;
            border-bottom: 2px solid var(--line);
        }

        .sort-control {
            padding-bottom: 2px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12.5px;
            color: var(--ink-3);
        }

        .sort-control select {
            appearance: none;
            background: none;
            border: none;
            font-size: 12.5px;
            font-weight: 800;
            color: var(--ink);
            cursor: pointer;
            font-family: inherit;
        }

        .content {
            padding: 28px 40px 60px;
            flex: 1;
        }

        .table-wrapper {
            background: var(--card);
            border-radius: 12px;
            border: 1px solid var(--line);
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: var(--surface);
            border-bottom: 2px solid var(--line);
        }

        th {
            padding: 14px 24px;
            font-family: 'Noto Serif', serif;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--ink-3);
            text-align: left;
        }

        tbody tr {
            border-bottom: 1px solid var(--line);
            transition: background 0.15s;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: var(--surface);
        }

        td {
            padding: 16px 24px;
            font-size: 13.5px;
        }

        .ref-id {
            font-weight: 800;
            color: var(--red);
            font-size: 12px;
            font-family: 'Noto Serif', serif;
        }

        .concern-type {
            font-weight: 700;
            color: var(--ink);
        }

        .resident-name {
            color: var(--ink-2);
        }

        .date-filed {
            color: var(--ink-3);
            font-size: 12.5px;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .status-pill::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .pill-pending {
            background: var(--gold-soft);
            color: var(--gold-dark);
        }

        .pill-pending::before {
            background: var(--gold);
        }

        .pill-inprogress {
            background: #fff3e0;
            color: #e65100;
        }

        .pill-inprogress::before {
            background: #ff9800;
        }

        .pill-resolved {
            background: var(--forest-pale);
            color: var(--forest);
        }

        .pill-resolved::before {
            background: var(--forest-bright);
        }

        .action-btn {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--ink-3);
            background: none;
            border: 1.5px solid var(--line);
            border-radius: 8px;
            padding: 6px 14px;
            cursor: pointer;
            transition: all 0.18s;
            font-family: inherit;
        }

        .action-btn:hover {
            border-color: var(--forest);
            color: var(--forest);
            background: var(--forest-pale);
        }

        .table-footer {
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--surface);
            border-top: 1px solid var(--line);
        }

        .table-footer-info {
            font-size: 12.5px;
            color: var(--ink-3);
        }

        .table-footer-info b {
            color: var(--ink);
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .pag-btn {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: 1.5px solid var(--line);
            background: var(--card);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 13px;
            color: var(--ink-3);
            transition: all 0.15s;
        }

        .pag-btn:hover:not(:disabled) {
            border-color: var(--forest);
            color: var(--forest);
        }

        .pag-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .pag-num {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            border: 1.5px solid var(--line);
            background: var(--card);
            color: var(--ink-2);
            transition: all 0.15s;
        }

        .pag-num:hover {
            border-color: var(--forest);
            color: var(--forest);
        }

        .pag-num.active {
            background: var(--forest);
            color: #fff;
            border-color: var(--forest);
        }

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(4px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal-box {
            background: var(--card);
            border-radius: 20px;
            width: 100%;
            max-width: 820px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.3);
            animation: popIn 0.25s ease;
        }

        @keyframes popIn {
            from {
                opacity: 0;
                transform: scale(0.96) translateY(12px);
            }
        }

        .modal-header {
            padding: 24px 32px 18px;
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            position: sticky;
            top: 0;
            background: var(--card);
            z-index: 5;
            border-radius: 20px 20px 0 0;
        }

        .modal-ref {
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--ink-3);
            margin-bottom: 4px;
        }

        .modal-ref span {
            color: var(--red);
        }

        .modal-title-text {
            font-family: 'Noto Serif', serif;
            font-size: 1.35rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--forest);
        }

        .modal-close {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: var(--surface);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            color: var(--ink-3);
            transition: all 0.15s;
        }

        .modal-close:hover {
            background: #fee;
            color: var(--red);
        }

        .modal-body {
            padding: 28px 32px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
        }

        .info-card {
            background: var(--surface);
            border-radius: 12px;
            border: 1px solid var(--line);
            padding: 16px;
        }

        .info-card-label {
            font-size: 9.5px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--ink-3);
            margin-bottom: 10px;
        }

        .info-card-main {
            font-size: 14px;
            font-weight: 700;
            color: var(--ink);
        }

        .info-card-sub {
            font-size: 12px;
            color: var(--ink-3);
            margin-top: 3px;
        }

        .map-placeholder {
            height: 80px;
            background: #d9e8e0;
            border-radius: 8px;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .map-placeholder::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                repeating-linear-gradient(0deg, transparent, transparent 16px, rgba(15, 61, 46, 0.06) 16px, rgba(15, 61, 46, 0.06) 17px),
                repeating-linear-gradient(90deg, transparent, transparent 16px, rgba(15, 61, 46, 0.06) 16px, rgba(15, 61, 46, 0.06) 17px);
        }

        .map-placeholder::after {
            content: '📍 Map';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 11px;
            font-weight: 700;
            color: var(--forest);
            background: rgba(255, 255, 255, 0.85);
            padding: 4px 10px;
            border-radius: 5px;
        }

        .control-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .control-group label {
            display: block;
            font-size: 9.5px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--ink-3);
            margin-bottom: 5px;
        }

        .control-group select {
            width: 100%;
            padding: 9px 12px;
            border: 1.5px solid var(--line);
            border-radius: 8px;
            font-size: 13px;
            color: var(--ink);
            background: var(--surface);
            transition: border-color 0.2s;
            appearance: none;
        }

        .control-group select:focus {
            border-color: var(--forest-mid);
        }

        .section-label {
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--ink-3);
            margin-bottom: 10px;
        }

        .description-block {
            padding: 18px 20px;
            background: var(--surface);
            border-left: 4px solid var(--forest);
            border-radius: 0 10px 10px 0;
            font-size: 13.5px;
            line-height: 1.8;
            color: var(--ink-2);
        }

        .image-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .image-row img {
            width: 110px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid var(--line);
            transition: border-color 0.15s;
        }

        .image-row img:hover {
            border-color: var(--forest-mid);
        }

        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .activity-log {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 13px;
            color: var(--ink-2);
        }

        .activity-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--forest-bright);
            flex-shrink: 0;
            margin-top: 5px;
        }

        .activity-date {
            font-size: 11px;
            color: var(--ink-3);
            font-weight: 700;
            margin-top: 2px;
        }

        .notes-area {
            width: 100%;
            padding: 12px;
            border: 1.5px solid var(--line);
            border-radius: 8px;
            font-size: 13px;
            color: var(--ink);
            background: var(--surface);
            resize: vertical;
            min-height: 90px;
            transition: border-color 0.2s;
            font-family: inherit;
            line-height: 1.7;
        }

        .notes-area:focus {
            border-color: var(--forest-mid);
        }

        .action-row {
            display: flex;
            gap: 8px;
            margin-top: 10px;
        }

        .btn-success {
            padding: 9px 16px;
            border-radius: 8px;
            border: none;
            background: var(--forest);
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s;
            font-family: inherit;
        }

        .btn-success:hover {
            background: var(--forest-mid);
        }

        .btn-info {
            padding: 9px 16px;
            border-radius: 8px;
            border: none;
            background: #e8f0fd;
            color: #1565c0;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s;
            font-family: inherit;
        }

        .btn-info:hover {
            background: #1565c0;
            color: #fff;
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-title">Barangay Officials</div>
            <div class="sidebar-brand-sub">Administrative Ledger</div>
        </div>
        <nav class="sidebar-nav">
            <a class="nav-item" href="#">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>
            <a class="nav-item active" href="#">
                <i class="fa-solid fa-file-lines"></i> Manage Concerns
            </a>
            <a class="nav-item" href="#">
                <i class="fa-solid fa-bell"></i> Notifications
            </a>
            <a class="nav-item" href="#">
                <i class="fa-solid fa-users"></i> Residents
            </a>
            <a class="nav-item" href="#">
                <i class="fa-solid fa-chart-bar"></i> Reports & Analytics
            </a>
            <a class="nav-item" href="#">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
        </nav>
        <div class="sidebar-footer">
            <button class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </div>
    </aside>

    <div class="main">
        <div class="page-header">
            <div class="header-top">
                <div>
                    <h1 class="header-title">Concern Reports</h1>
                    <p class="header-desc">Review, track, and update status of community reports submitted by residents.</p>
                </div>
                <div class="search-bar">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Search by ID, name, or type...">
                </div>
            </div>

            <div class="tab-bar">
                <button class="tab-item active" data-filter="all">
                    All Reports <span class="badge-count" id="allCount">42</span>
                </button>
                <button class="tab-item" data-filter="pending">
                    Pending <span class="badge-count" id="pendingCount">10</span>
                </button>
                <button class="tab-item" data-filter="inprogress">
                    In-Progress <span class="badge-count" id="progressCount">8</span>
                </button>
                <button class="tab-item" data-filter="resolved">
                    Resolved <span class="badge-count" id="resolvedCount">23</span>
                </button>
                <div class="tab-divider"></div>
                <div class="sort-control">
                    Sort by:
                    <select id="sortFilter">
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="status">By Status</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Reference ID</th>
                            <th>Concern Type</th>
                            <th>Resident</th>
                            <th>Date Filed</th>
                            <th>Status</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="reportTableBody">
                    </tbody>
                </table>

                <div class="table-footer">
                    <div class="table-footer-info" id="paginationInfo">Showing <b>1–5</b> of <b>42</b> results</div>
                    <div class="pagination" id="paginationControls">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="reportModal">
        <div class="modal-box">
            <div class="modal-header">
                <div>
                    <div class="modal-ref">Reference: <span id="modalRef">#BRGY-2024-001</span></div>
                    <div class="modal-title-text">Concern Report Details</div>
                </div>
                <button class="modal-close" id="closeModal">✕</button>
            </div>
            <div class="modal-body" id="modalBody">
            </div>
        </div>
    </div>
</body>

</html>