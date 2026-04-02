<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eMASID — Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700;900&family=Nunito+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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
            --red-soft: #fdf0f0;
            --blue: #1565c0;
            --blue-soft: #e8f0fd;
            --ink: #1b1c19;
            --ink-2: #414944;
            --ink-3: #717974;
            --line: #e0e4e0;
            --surface: #faf9f4;
            --card: #ffffff;
            --sidebar-w: 256px;
            --topbar-h: 64px;
            --r: 12px;
            --r-sm: 8px;
            --shadow: 0 2px 12px rgba(15, 61, 46, .07);
            --shadow-md: 0 4px 20px rgba(15, 61, 46, .10);
        }

        body {
            font-family: 'Nunito Sans', sans-serif;
            background: var(--surface);
            color: var(--ink);
            min-height: 100vh;
        }

        .hidden {
            display: none !important;
        }

        .admin-topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--topbar-h);
            z-index: 200;
            background: var(--forest);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px 0 calc(var(--sidebar-w) + 28px);
            box-shadow: 0 2px 16px rgba(0, 0, 0, .18);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .topbar-page-title {
            font-family: 'Noto Serif', serif;
            font-size: 1rem;
            font-weight: 900;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: #fff;
        }

        .topbar-breadcrumb {
            font-size: 11.5px;
            color: rgba(255, 255, 255, .45);
            margin-top: 2px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(255, 255, 255, .1);
            border: none;
            color: rgba(255, 255, 255, .75);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            transition: all .18s;
            position: relative;
        }

        .topbar-icon-btn:hover {
            background: rgba(255, 255, 255, .18);
            color: #fff;
        }

        .notif-dot {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--gold);
            border: 1.5px solid var(--forest);
        }

        .topbar-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, .1);
            border-radius: 10px;
            padding: 6px 12px 6px 8px;
            cursor: pointer;
            transition: all .18s;
        }

        .topbar-profile:hover {
            background: rgba(255, 255, 255, .18);
        }

        .topbar-avatar {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 900;
            color: var(--gold-dark);
        }

        .topbar-profile-name {
            font-size: 12.5px;
            font-weight: 700;
            color: #fff;
        }

        .topbar-profile-role {
            font-size: 10px;
            color: rgba(255, 255, 255, .5);
        }

        .admin-layout {
            display: flex;
            padding-top: var(--topbar-h);
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: var(--sidebar-w);
            background: var(--forest);
            display: flex;
            flex-direction: column;
            z-index: 150;
            padding-top: var(--topbar-h);
        }

        .sidebar-brand {
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255, 255, 255, .12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .sidebar-brand-title {
            font-family: 'Noto Serif', serif;
            font-weight: 900;
            font-size: .95rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: #fff;
        }

        .sidebar-brand-sub {
            font-size: 9.5px;
            color: rgba(255, 255, 255, .4);
            text-transform: uppercase;
            letter-spacing: .1em;
            font-weight: 600;
            margin-top: 2px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 14px 12px;
            display: flex;
            flex-direction: column;
            gap: 3px;
            overflow-y: auto;
        }

        .sidebar-section-label {
            font-size: 9px;
            font-weight: 900;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .3);
            padding: 10px 10px 4px;
            margin-top: 6px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            color: rgba(255, 255, 255, .55);
            cursor: pointer;
            transition: all .18s;
            background: none;
            border: none;
            text-align: left;
            width: 100%;
        }

        .sidebar-link i {
            width: 16px;
            text-align: center;
            font-size: 13.5px;
        }

        .sidebar-link .link-badge {
            margin-left: auto;
            background: rgba(255, 255, 255, .1);
            border-radius: 20px;
            padding: 1px 7px;
            font-size: 10px;
            color: rgba(255, 255, 255, .5);
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, .08);
            color: rgba(255, 255, 255, .9);
        }

        .sidebar-link.active {
            background: rgba(255, 255, 255, .13);
            color: #fff;
            box-shadow: inset 3px 0 0 var(--gold);
        }

        .sidebar-footer {
            padding: 14px 14px;
            border-top: 1px solid rgba(255, 255, 255, .08);
        }

        .logout-btn {
            width: 100%;
            padding: 11px;
            background: var(--gold);
            color: var(--gold-dark);
            border: none;
            border-radius: 10px;
            font-family: 'Noto Serif', serif;
            font-size: 11.5px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all .18s;
        }

        .logout-btn:hover {
            background: #ffe066;
        }

        .admin-main {
            margin-left: var(--sidebar-w);
            flex: 1;
            padding: 32px 36px 60px;
            min-width: 0;
        }

        .view-header {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }

        .view-header-text .subheading {
            font-size: 10.5px;
            font-weight: 900;
            letter-spacing: .15em;
            text-transform: uppercase;
            color: var(--ink-3);
            margin-bottom: 3px;
        }

        .view-header-text h2 {
            font-family: 'Noto Serif', serif;
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--forest);
        }

        .view-header-spacer {
            flex: 1;
        }

        .btn {
            padding: 10px 20px;
            border-radius: var(--r-sm);
            border: none;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all .18s;
            font-family: inherit;
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .btn.primary {
            background: var(--forest);
            color: #fff;
        }

        .btn.primary:hover {
            background: var(--forest-mid);
        }

        .btn.back {
            background: var(--card);
            color: var(--ink-2);
            border: 1.5px solid var(--line);
        }

        .btn.back:hover {
            border-color: var(--forest);
            color: var(--forest);
        }

        .btn.ghost {
            background: none;
            border: 1.5px solid var(--line);
            color: var(--ink-2);
        }

        .btn.ghost:hover {
            border-color: var(--forest);
            color: var(--forest);
        }

        .search-input-wrap {
            display: flex;
            align-items: center;
            gap: 9px;
            background: var(--card);
            border: 1.5px solid var(--line);
            border-radius: 50px;
            padding: 9px 16px;
            transition: border-color .2s;
        }

        .search-input-wrap:focus-within {
            border-color: var(--forest-mid);
        }

        .search-input-wrap i {
            color: var(--ink-3);
            font-size: 12.5px;
        }

        .search-input-wrap input {
            border: none;
            background: none;
            font-size: 13px;
            color: var(--ink);
            width: 220px;
        }

        .dashboard-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 28px;
        }

        .dashboard-head h1 {
            font-family: 'Noto Serif', serif;
            font-size: 1.65rem;
            font-weight: 900;
            color: var(--forest);
        }

        .dashboard-head p {
            font-size: 13.5px;
            color: var(--ink-3);
            margin-top: 4px;
        }

        .dashboard-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--card);
            border-radius: var(--r);
            border: 1px solid var(--line);
            padding: 20px 22px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
        }

        .stat-card:nth-child(1)::before {
            background: var(--forest-bright);
        }

        .stat-card:nth-child(2)::before {
            background: var(--gold);
        }

        .stat-card:nth-child(3)::before {
            background: var(--blue);
        }

        .stat-card:nth-child(4)::before {
            background: var(--red);
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--ink-3);
        }

        .stat-num {
            font-family: 'Noto Serif', serif;
            font-size: 2rem;
            font-weight: 900;
            color: var(--ink);
            line-height: 1;
        }

        .city-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 16px;
        }

        .city-card {
            background: var(--card);
            border-radius: var(--r);
            border: 1px solid var(--line);
            padding: 20px;
            box-shadow: var(--shadow);
            cursor: pointer;
            transition: all .2s;
        }

        .city-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-3px);
            border-color: var(--forest-bright);
        }

        .city-card-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--forest-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 14px;
        }

        .city-card-name {
            font-family: 'Noto Serif', serif;
            font-size: 1rem;
            font-weight: 900;
            color: var(--ink);
            margin-bottom: 4px;
        }

        .city-card-meta {
            font-size: 12px;
            color: var(--ink-3);
        }

        .city-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 14px;
            padding-top: 12px;
            border-top: 1px solid var(--line);
        }

        .city-card-count {
            font-size: 11px;
            font-weight: 700;
            color: var(--forest-mid);
            background: var(--forest-pale);
            padding: 3px 10px;
            border-radius: 20px;
        }

        .city-card-arrow {
            color: var(--ink-3);
            font-size: 13px;
            transition: transform .18s;
        }

        .city-card:hover .city-card-arrow {
            transform: translateX(3px);
            color: var(--forest);
        }

        .barangay-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 14px;
            margin-bottom: 24px;
        }

        .summary-stat {
            background: var(--card);
            border-radius: var(--r);
            border: 1px solid var(--line);
            padding: 16px 18px;
            box-shadow: var(--shadow);
        }

        .summary-stat .s-label {
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: var(--ink-3);
            margin-bottom: 6px;
        }

        .summary-stat .s-val {
            font-family: 'Noto Serif', serif;
            font-size: 1.6rem;
            font-weight: 900;
            color: var(--forest);
        }

        .section {
            margin-bottom: 28px;
        }

        .section h3 {
            font-family: 'Noto Serif', serif;
            font-size: .95rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--ink-2);
            margin-bottom: 14px;
        }

        .role-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .people-card {
            background: var(--card);
            border-radius: var(--r);
            border: 1px solid var(--line);
            padding: 18px;
            box-shadow: var(--shadow);
        }

        .people-card h4 {
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: var(--ink-3);
            margin-bottom: 12px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--line);
        }

        .people-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .person-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
            border-radius: 8px;
        }

        .person-item:hover {
            background: var(--surface);
        }

        .person-avatar {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--forest-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 800;
            color: var(--forest-mid);
            flex-shrink: 0;
        }

        .person-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
        }

        .person-role {
            font-size: 11px;
            color: var(--ink-3);
            margin-top: 1px;
        }

        .person-empty {
            font-size: 12.5px;
            color: var(--ink-3);
            text-align: center;
            padding: 16px;
            background: var(--surface);
            border-radius: 8px;
        }

        .post-card {
            background: var(--card);
            border-radius: var(--r);
            border: 1px solid var(--line);
            padding: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 14px;
        }

        .post-card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .post-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .post-avatar {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: var(--forest-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 800;
            color: var(--forest-mid);
        }

        .post-user-name {
            font-size: 13.5px;
            font-weight: 800;
            color: var(--ink);
        }

        .post-user-loc {
            font-size: 11px;
            color: var(--ink-3);
            margin-top: 1px;
        }

        .post-badge-row {
            display: flex;
            gap: 6px;
        }

        .post-badge {
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 9.5px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .pb-open {
            background: var(--forest-pale);
            color: var(--forest);
        }

        .pb-road {
            background: var(--blue-soft);
            color: var(--blue);
        }

        .pb-waste {
            background: #fbe9e7;
            color: #bf360c;
        }

        .pb-light {
            background: var(--gold-soft);
            color: var(--gold-dark);
        }

        .pb-flood {
            background: #e3f2fd;
            color: #1565c0;
        }

        .pb-high {
            background: #fbe9e7;
            color: #c62828;
        }

        .pb-medium {
            background: var(--gold-soft);
            color: #795800;
        }

        .pb-low {
            background: #f1f8e9;
            color: #558b2f;
        }

        .pb-resolved {
            background: var(--forest-pale);
            color: var(--forest);
        }

        .post-title {
            font-family: 'Noto Serif', serif;
            font-size: .95rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 5px;
        }

        .post-desc {
            font-size: 13px;
            color: var(--ink-2);
            line-height: 1.7;
        }

        .post-footer {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 14px;
            padding-top: 12px;
            border-top: 1px solid var(--line);
        }

        .post-meta {
            font-size: 11.5px;
            color: var(--ink-3);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .post-action-btn {
            padding: 6px 12px;
            border-radius: 7px;
            border: 1.5px solid var(--line);
            font-size: 11.5px;
            font-weight: 700;
            color: var(--ink-3);
            background: none;
            cursor: pointer;
            transition: all .15s;
        }

        .post-action-btn:hover {
            border-color: var(--forest);
            color: var(--forest);
            background: var(--forest-pale);
        }

        .settings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }

        .settings-card {
            background: var(--card);
            border-radius: var(--r);
            border: 1px solid var(--line);
            padding: 22px;
            box-shadow: var(--shadow);
        }

        .settings-card h3 {
            font-family: 'Noto Serif', serif;
            font-size: .9rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--forest);
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--line);
        }

        .setting-row {
            margin-bottom: 14px;
        }

        .setting-row label {
            display: block;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: var(--ink-3);
            margin-bottom: 5px;
        }

        .setting-row input,
        .setting-row textarea {
            width: 100%;
            padding: 9px 12px;
            border: 1.5px solid var(--line);
            border-radius: 8px;
            font-size: 13px;
            color: var(--ink);
            background: var(--surface);
        }

        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid var(--line);
        }

        .toggle-row span {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--ink-2);
        }

        .switch {
            position: relative;
            width: 42px;
            height: 24px;
            flex-shrink: 0;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            inset: 0;
            background: var(--line);
            border-radius: 24px;
            cursor: pointer;
            transition: .2s;
        }

        .slider::before {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            left: 3px;
            top: 3px;
            background: white;
            border-radius: 50%;
            transition: .2s;
        }

        .switch input:checked+.slider {
            background: var(--forest-bright);
        }

        .switch input:checked+.slider::before {
            transform: translateX(18px);
        }

        .settings-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 8px;
        }

        .settings-status {
            font-size: 12.5px;
            font-weight: 700;
            color: var(--forest-mid);
        }

        .empty-state {
            text-align: center;
            padding: 48px 24px;
            background: var(--card);
            border-radius: var(--r);
            border: 1px solid var(--line);
        }

        .empty-state-icon {
            font-size: 40px;
            margin-bottom: 12px;
        }

        .empty-state h3 {
            font-family: 'Noto Serif', serif;
            font-size: 1rem;
            font-weight: 900;
            color: var(--ink-2);
            margin-bottom: 5px;
        }

        .empty-state p {
            font-size: 13px;
            color: var(--ink-3);
        }

        .header-admin-card {
            background: rgba(255, 255, 255, .07);
            border-radius: 10px;
            padding: 12px 16px;
            border: 1px solid rgba(255, 255, 255, .1);
        }

        .header-admin-card h4 {
            font-size: 9px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .15em;
            color: rgba(255, 255, 255, .4);
            margin-bottom: 8px;
        }
    </style>
</head>

<body>

    <header class="admin-topbar">
        <div class="topbar-left">
            <div>
                <div class="topbar-page-title" id="topbarTitle">Dashboard</div>
                <div class="topbar-breadcrumb">eMASID · Super Admin</div>
            </div>
        </div>
        <div class="topbar-right">
            <button class="topbar-icon-btn"><i class="fa-solid fa-bell"></i><span class="notif-dot"></span></button>
            <div class="topbar-profile">
                <div class="topbar-avatar">A</div>
                <div>
                    <div class="topbar-profile-name">Admin</div>
                    <div class="topbar-profile-role">Super Administrator</div>
                </div>
            </div>
        </div>
    </header>

    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-brand">
                <div class="sidebar-brand-icon">🌿</div>
                <div>
                    <div class="sidebar-brand-title">eMASID</div>
                    <div class="sidebar-brand-sub">Management</div>
                </div>
            </div>
            <nav class="sidebar-nav">
                <div class="sidebar-section-label">Overview</div>
                <button class="sidebar-link active" data-view="dashboard"><i class="fa-solid fa-gauge-high"></i> Dashboard</button>
                <div class="sidebar-section-label">Manage</div>
                <button class="sidebar-link" data-view="cities"><i class="fa-solid fa-city"></i> Cities <span class="link-badge" id="citiesCountBadge">3</span></button>
                <button class="sidebar-link" data-view="barangays"><i class="fa-solid fa-map-location-dot"></i> Barangays <span class="link-badge" id="barangaysCountBadge">6</span></button>
                <button class="sidebar-link" data-view="posts"><i class="fa-solid fa-file-lines"></i> Posts <span class="link-badge" id="postsCountBadge">4</span></button>
                <div class="sidebar-section-label">System</div>
                <button class="sidebar-link" data-view="settings"><i class="fa-solid fa-gear"></i> Settings</button>
            </nav>
            <div class="sidebar-footer"><button class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</button></div>
        </aside>

        <main class="admin-main">
            <!-- DASHBOARD -->
            <section id="dashboardView">
                <div class="dashboard-head">
                    <div>
                        <h1>Welcome back, Admin</h1>
                        <p>Overview of system activity across all cities.</p>
                    </div>
                    <div class="dashboard-actions">
                        <div class="search-input-wrap"><i class="fa-solid fa-magnifying-glass"></i><input type="text" id="citySearchInput" placeholder="Search city..."></div>
                    </div>
                </div>
                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-icon" style="background:var(--forest-pale);color:var(--forest-mid);"><i class="fa-solid fa-city"></i></div>
                        <div class="stat-label">Total Cities</div>
                        <div class="stat-num">3</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background:var(--gold-soft);color:var(--gold-dark);"><i class="fa-solid fa-map-location-dot"></i></div>
                        <div class="stat-label">Total Barangays</div>
                        <div class="stat-num">6</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background:var(--blue-soft);color:var(--blue);"><i class="fa-solid fa-file-lines"></i></div>
                        <div class="stat-label">Total Posts</div>
                        <div class="stat-num">4</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background:var(--red-soft);color:var(--red);"><i class="fa-solid fa-circle-exclamation"></i></div>
                        <div class="stat-label">Pending Action</div>
                        <div class="stat-num">3</div>
                    </div>
                </div>
                <div class="grid-section-header">
                    <div class="grid-section-title">Cities</div>
                </div>
                <div id="cityGridContainer" class="city-grid"></div>
            </section>

            <!-- ALL BARANGAYS -->
            <section id="allBarangaysView" class="hidden">
                <div class="view-header">
                    <div class="view-header-text">
                        <p class="subheading">All Locations</p>
                        <h2>All Barangays</h2>
                    </div>
                </div>
                <div id="allBarangaysList" class="city-grid"></div>
            </section>

            <!-- POSTS -->
            <section id="postsView" class="hidden">
                <div class="view-header">
                    <div class="view-header-text">
                        <p class="subheading">Community Reports</p>
                        <h2>All Posts</h2>
                    </div>
                </div>
                <div id="postsFeed"></div>
            </section>

            <!-- SETTINGS -->
            <section id="settingsView" class="hidden">
                <div class="view-header">
                    <div class="view-header-text">
                        <p class="subheading">Configuration</p>
                        <h2>Admin Settings</h2>
                    </div>
                </div>
                <div class="settings-grid">
                    <div class="settings-card">
                        <h3>General</h3>
                        <div class="setting-row"><label>Site Title</label><input type="text" value="eMASID Admin"></div>
                        <div class="setting-row"><label>Admin Email</label><input type="email" value="admin@emasid.local"></div>
                    </div>
                    <div class="settings-card">
                        <h3>System Preferences</h3>
                        <div class="toggle-row"><span>Enable Notifications</span><label class="switch"><input type="checkbox" checked><span class="slider"></span></label></div>
                        <div class="toggle-row"><span>Maintenance Mode</span><label class="switch"><input type="checkbox"><span class="slider"></span></label></div>
                    </div>
                </div>
                <div class="settings-actions"><button id="saveSettingsBtn" class="btn primary"><i class="fa-solid fa-floppy-disk"></i> Save Settings</button><span id="settingsStatus" class="settings-status"></span></div>
            </section>

            <!-- CITY DETAIL (BARANGAY LIST) -->
            <section id="cityDetailView" class="hidden">
                <div class="view-header"><button class="btn back" id="backFromCityBtn"><i class="fa-solid fa-arrow-left"></i> Back</button>
                    <div class="view-header-text">
                        <p class="subheading">City Details</p>
                        <h2 id="cityDetailTitle"></h2>
                    </div>
                </div>
                <div id="cityBarangayList" class="city-grid"></div>
            </section>

            <!-- BARANGAY DETAIL -->
            <section id="barangayDetailView" class="hidden">
                <div class="view-header"><button class="btn back" id="backFromBarangayBtn"><i class="fa-solid fa-arrow-left"></i> Back</button>
                    <div class="view-header-text">
                        <p class="subheading">Barangay Details</p>
                        <h2 id="barangayDetailTitle"></h2>
                    </div>
                    <div class="view-header-spacer"></div>
                    <div class="people-card header-admin-card" style="background:var(--forest-pale);min-width:200px;">
                        <h4 style="color:var(--ink-3);">Assigned Admin</h4>
                        <div id="adminDisplay" class="people-list"></div>
                    </div>
                </div>
                <div id="barangaySummaryStats" class="barangay-summary"></div>
                <div class="section">
                    <h3>People</h3>
                    <div class="role-grid">
                        <div class="people-card">
                            <h4>Officials</h4>
                            <div id="officialsDetailList" class="people-list"></div>
                        </div>
                        <div class="people-card">
                            <h4>Citizens</h4>
                            <div id="citizensDetailList" class="people-list"></div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>