<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-green: #1a7a5e;
            --hover-green: #145c47;
            --bg-light: #f4f7f6;
            --text-dark: #2d3436;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Nunito Sans', sans-serif;
        }

        body {
            background-color: var(--bg-light);
            height: 200vh; /* Added height to test the scroll-to-hide feature */
        }

        nav {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            align-items: center;
            background-color: var(--primary-green);
            height: 80px;
            padding: 0 40px;
            color: white;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        /* Brand Section */
        .webname {
            display: flex;
            align-items: center;
            gap: 15px;
            cursor: pointer;
        }

        .logo {
            width: 45px;
            height: 45px;
            transition: transform 0.3s ease;
        }
        
        .webname:hover .logo {
            transform: scale(1.05);
        }

        .webTitle h2 {
            font-size: 1.4rem;
            letter-spacing: 1px;
            line-height: 1;
        }

        .webTitle span {
            font-size: 0.85rem;
            opacity: 0.9;
            font-weight: 300;
        }

        /* Search Section */
        .userSearchContainer {
            display: flex;
            justify-content: center;
            position: relative; /* Required for absolute positioning of suggestions */
        }

        .userSearch {
            background-color: rgba(255, 255, 255, 0.15);
            padding: 8px 20px;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .userSearch:focus-within {
            background-color: white;
            border-color: #f4b942;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .userSearch i {
            color: rgba(255, 255, 255, 0.7);
            transition: color 0.3s;
        }

        .userSearch:focus-within i {
            color: var(--primary-green);
        }

        .userSearch input {
            width: 100%;
            border: none;
            background: transparent;
            font-size: 0.95rem;
            outline: none;
            color: white;
        }

        .userSearch:focus-within input {
            color: var(--text-dark);
        }

        .userSearch input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        /* Search Suggestions Dropdown */
        .search-results {
            position: absolute;
            top: calc(100% + 5px);
            width: 100%;
            max-width: 500px;
            background: white;
            border-radius: 10px;
            box-shadow: var(--shadow);
            display: none; /* Hidden by default */
            flex-direction: column;
            overflow: hidden;
            z-index: 1001;
        }

        .search-results div {
            padding: 12px 20px;
            color: var(--text-dark);
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.9rem;
        }

        .search-results div:last-child {
            border-bottom: none;
        }

        .search-results div:hover {
            background-color: #f8f9f9;
            color: var(--primary-green);
            padding-left: 25px;
            transition: all 0.2s ease;
        }

        /* User Profile Section */
        .user {
            position: relative;
            display: flex;
            justify-content: flex-end;
        }

        .userContainer {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 6px 6px 15px;
            border-radius: 12px;
            transition: background 0.2s;
            cursor: pointer;
        }

        .userContainer:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .user-role {
            text-align: right;
        }

        .username {
            display: block;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .role {
            display: block;
            font-size: 0.75rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .profile {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid rgba(255,255,255,0.2);
        }

        /* User Controls Dropdown */
        .userControls {
            position: absolute;
            top: 120%;
            right: 0;
            width: 220px;
            background-color: white;
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 10px;
            display: none; /* Controlled by JS class 'active' */
            flex-direction: column;
            overflow: hidden;
            animation: slideDown 0.2s ease-out;
        }

        .userControls.active {
            display: flex;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .userControls div, .userControls .logout {
            padding: 10px 15px;
            color: var(--text-dark);
            font-size: 0.9rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background 0.2s;
            cursor: pointer;
        }

        .userControls .logout {
            padding: 0;
            text-decoration: none;
            border-top: 1px solid #eee;
            margin-top: 5px;
        }

        .userControls div:hover, .userControls .logout:hover {
            background-color: #f0f2f1;
            color: var(--primary-green);
        }
        .userControls .logoutButton {
            border: none;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
            padding: 10px 15px;
            background: transparent;
            width: 100%;
            height: 100%;
            outline: none;
            cursor: pointer;
            color: #e74c3c !important;
        }

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <nav>
        <div class="webname" id="brandHome">
            <div class="logo">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='48' fill='%23ffffff' stroke='%23f4b942' stroke-width='2'/%3E%3Cpath fill='%231a7a5e' d='M50 20 L70 35 L70 65 L50 80 L30 65 L30 35 Z' opacity='0.95'/%3E%3Ctext x='50' y='68' font-size='34' text-anchor='middle' fill='white' font-weight='bold' font-family='monospace'%3EM%3C/text%3E%3C/svg%3E" alt="Logo">
            </div>
            <div class="webTitle">
                <h2>eMASID</h2>
                <span>
                    @if(isset($user))
                        {{ $user->barangay->brgy_name }}
                    @endif
                </span>
            </div>
        </div>

        <div class="userSearchContainer">
            <div class="userSearch">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Search residents or services..." autocomplete="off">
            </div>
            <div id="searchResults" class="search-results"></div>
        </div>

        <div class="user" id="userProfileBtn">
            <div class="userContainer">
                <div class="user-role">
                    <span class="username">
                        @if(isset($user))
                            {{ $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name }}
                        @endif
                    </span>
                    <span class="role">
                        <!-- 'San Luis' will change into the current barangay -->
                        @if(isset($user) && $user->barangay->brgy_name === 'San Luis')
                            Resident
                        @elseif(isset($user))
                            Concerned Citizen
                        @endif
                    </span>
                </div>
                <div class="profile">
                    <img src="https://picsum.photos/id/102/150/150" alt="User Profile">
                </div>
            </div>
            
            <div class="userControls" id="userDropdown">
                <div class="editprofile"><i class="fa-regular fa-user"></i> My Profile</div>
                <div class="settings"><i class="fa-solid fa-gear"></i> Settings</div>
                <div class="notification"><i class="fa-regular fa-bell"></i> Notifications</div>
                <div class="myPost"><i class="fa-regular fa-pen-to-square"></i> My Posts</div>
                <div class="theme"><i class="fa-solid fa-moon"></i> Dark Mode</div>

                <form class="logout" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logoutButton">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    @include('residentUI.userNav.content')

    <script>
        // --- DATA ---
        const barangayData = [
            "Barangay Matatag",
            "Barangay Malakas",
            "Barangay Pag-asa",
            "Barangay San Lorenzo",
            "Barangay Maharlika",
            "Barangay Silangan",
            "Health Certificate Issuance",
            "Business Permit Renewal",
            "Cedula / Community Tax",
            "Indigency Certificate"
        ];

        // --- ELEMENTS ---
        const userProfileBtn = document.getElementById('userProfileBtn');
        const userDropdown = document.getElementById('userDropdown');
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');

        // --- PROFILE DROPDOWN LOGIC ---
        
        // Toggle on click
        userProfileBtn.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevents document click from firing immediately
            userDropdown.classList.toggle('active');
        });

        // Close when clicking outside or scrolling
        const closeAllPopups = () => {
            userDropdown.classList.remove('active');
            searchResults.style.display = 'none';
        };

        document.addEventListener('click', closeAllPopups);
        
        window.addEventListener('scroll', () => {
            // Only hide if the dropdown is currently open to save performance
            if(userDropdown.classList.contains('active') || searchResults.style.display === 'flex') {
                closeAllPopups();
            }
        });

        // Prevent closing when clicking inside the dropdown
        userDropdown.addEventListener('click', (e) => e.stopPropagation());

        // --- SEARCH BAR LOGIC ---

        searchInput.addEventListener('input', (e) => {
            const val = e.target.value.toLowerCase();
            searchResults.innerHTML = ''; // Clear previous results

            if (val.length > 0) {
                // Filter data based on input
                const matches = barangayData.filter(item => 
                    item.toLowerCase().includes(val)
                );

                if (matches.length > 0) {
                    matches.forEach(match => {
                        const div = document.createElement('div');
                        div.textContent = match;
                        // When a choice is clicked
                        div.addEventListener('click', () => {
                            searchInput.value = match;
                            searchResults.style.display = 'none';
                        });
                        searchResults.appendChild(div);
                    });
                    searchResults.style.display = 'flex';
                } else {
                    searchResults.style.display = 'none';
                }
            } else {
                // If empty, hide results
                searchResults.style.display = 'none';
            }
        });

        // Prevent search input click from closing the popup
        searchInput.addEventListener('click', (e) => e.stopPropagation());

    </script>
</body>
</html>