<nav class="main-navbar">
    <!-- Logo Section -->
    <div class="nav-brand">
        <a href="{{ url('LandingPage') }}" class="logo-link">
            <img src="{{ asset('assets/img/kaiadmin/logo.png') }}" alt="Logo" class="logo-img">
        </a>
        <button class="nav-toggle-btn" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- User Profile Section -->
    <div class="nav-user-menu">
        <div class="user-dropdown">
            <button class="user-profile-btn" id="userDropdownBtn">
                @if(Auth::user()->profile_photo_path)
                    <img src="{{ asset('storage/'.Auth::user()->profile_photo_path) }}" alt="Profile" class="user-avatar">
                @else
                    <div class="avatar-initials">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                @endif
                <span class="user-greeting">Hi, <span class="user-name">{{ Auth::user()->name }}</span></span>
                <i class="fas fa-chevron-down dropdown-arrow"></i>
            </button>

            <div class="dropdown-menu" id="userDropdown">
                <div class="user-info-card">
                    <div class="user-avatar-lg">
                        @if(Auth::user()->profile_photo_path)
                            <img src="{{ asset('storage/'.Auth::user()->profile_photo_path) }}" alt="Profile" class="profile-img-lg">
                        @else
                            <div class="avatar-initials-lg">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="user-details">
                        <h4 class="user-fullname">{{ Auth::user()->name }}</h4>
                        <p class="user-email">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <div class="dropdown-divider"></div>

                <a href="{{ route('signout') }}" class="dropdown-item logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                    <div class="logout-hover-effect"></div>
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    /* ===== Modern Navbar Styles ===== */
    .main-navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 70px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 30px;
        background: linear-gradient(135deg, var(--dark-blue), var(--light-blue));
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        z-index: 1000;
        border-bottom: 1px solid rgba(163, 234, 42, 0.2);
    }

    /* Logo Section */
    .nav-brand {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .logo-link {
        display: flex;
        align-items: center;
    }

    .logo-img {
        height: 28px;
        transition: transform 0.3s ease;
    }

    .logo-link:hover .logo-img {
        transform: scale(1.05);
        filter: drop-shadow(0 0 8px rgba(163, 234, 42, 0.6));
    }

    .nav-toggle-btn {
        background: transparent;
        border: none;
        color: white;
        font-size: 1.4rem;
        cursor: pointer;
        padding: 8px;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .nav-toggle-btn:hover {
        background: rgba(163, 234, 42, 0.2);
        color: var(--accent-green);
    }

    /* User Profile Section */
    .user-dropdown {
        position: relative;
    }

    .user-profile-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        background: transparent;
        border: none;
        color: white;
        cursor: pointer;
        padding: 8px 15px;
        border-radius: 30px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .user-profile-btn:hover {
        background: rgba(163, 234, 42, 0.1);
    }

    .user-profile-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(163, 234, 42, 0.1), transparent);
        transform: translateX(-100%);
        transition: transform 0.6s ease;
    }

    .user-profile-btn:hover::before {
        transform: translateX(100%);
    }

    .user-avatar, .avatar-initials {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
    }

    .avatar-initials {
        background: var(--accent-green);
        color: var(--dark-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.1rem;
    }

    .user-greeting {
        font-size: 0.9rem;
        opacity: 0.8;
    }

    .user-name {
        font-weight: 600;
        color: white;
    }

    .dropdown-arrow {
        font-size: 0.8rem;
        transition: transform 0.3s ease;
    }

    /* Dropdown Menu */
    .dropdown-menu {
        position: absolute;
        right: 0;
        top: calc(100% + 10px);
        width: 280px;
        background: var(--dark-blue);
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(163, 234, 42, 0.1);
        padding: 0;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.3s ease;
        z-index: 1001;
    }

    .user-dropdown.active .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .user-dropdown.active .dropdown-arrow {
        transform: rotate(180deg);
    }

    .user-info-card {
        padding: 20px;
        text-align: center;
        border-bottom: 1px solid rgba(163, 234, 42, 0.1);
    }

    .user-avatar-lg, .avatar-initials-lg {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin: 0 auto 15px;
        object-fit: cover;
        border: 3px solid var(--accent-green);
    }

    .avatar-initials-lg {
        background: var(--accent-green);
        color: var(--dark-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 2rem;
    }

    .user-fullname {
        color: white;
        margin-bottom: 5px;
        font-size: 1.2rem;
    }

    .user-email {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
    }

    .dropdown-divider {
        height: 1px;
        background: rgba(163, 234, 42, 0.1);
        margin: 0;
    }

    .logout-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px 20px;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .logout-btn:hover {
        color: white;
        background: rgba(255, 255, 255, 0.05);
    }

    .logout-hover-effect {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: var(--accent-green);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
    }

    .logout-btn:hover .logout-hover-effect {
        transform: scaleX(1);
    }

    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .dropdown-menu {
        animation: fadeIn 0.3s ease forwards;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .main-navbar {
            padding: 0 15px;
        }

        .user-name {
            display: none;
        }

        .user-greeting {
            display: none;
        }

        .user-profile-btn {
            padding: 8px;
        }
    }
</style>

<script>
    // Toggle dropdown menu
    document.getElementById('userDropdownBtn').addEventListener('click', function() {
        document.querySelector('.user-dropdown').classList.toggle('active');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.querySelector('.user-dropdown');
        if (!dropdown.contains(event.target)) {
            dropdown.classList.remove('active');
        }
    });

    // Sidebar toggle functionality
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        // Add your sidebar toggle logic here
        console.log('Sidebar toggle clicked');
    });
</script>
