<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Control Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --dark-blue: #001a33;
            --accent-green: rgb(163, 234, 42);
            --light-blue: #003366;
            --neon-glow: 0 0 15px rgba(163, 234, 42, 0.5);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --card-bg: rgba(255, 255, 255, 0.95);
        }

        body {
            background-color: var(--dark-blue);
            background-image:
                radial-gradient(circle at 25% 25%, rgba(0, 82, 163, 0.3) 0%, transparent 35%),
                radial-gradient(circle at 75% 75%, rgba(163, 234, 42, 0.2) 0%, transparent 35%);
            min-height: 100vh;
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .dashboard-header {
            background: linear-gradient(135deg, var(--dark-blue), var(--light-blue));
            color: white;
            padding: 25px 0;
            border-bottom: 3px solid var(--accent-green);
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
            z-index: 2;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg,
                        transparent,
                        rgba(163, 234, 42, 0.1),
                        transparent);
            pointer-events: none;
        }

        .dashboard-title {
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
            position: relative;
            display: inline-block;
        }

        .dashboard-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--accent-green);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.5s ease;
        }

        .dashboard-title:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .dashboard-container {
            padding: 40px 20px;
            position: relative;
            z-index: 1;
        }

        .dashboard-container::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, var(--accent-green), transparent 70%);
            opacity: 0.1;
            z-index: -1;
        }

        .feature-box {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: float 6s ease-in-out infinite;
        }

        .feature-box:nth-child(1) { animation-delay: 0s; }
        .feature-box:nth-child(2) { animation-delay: 0.5s; }
        .feature-box:nth-child(3) { animation-delay: 1s; }
        .feature-box:nth-child(4) { animation-delay: 1.5s; }

        .feature-box:hover {
            transform: translateY(-15px) scale(1.03);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2), var(--neon-glow);
            animation-play-state: paused;
        }

        .feature-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg,
                        var(--accent-green),
                        var(--light-blue),
                        var(--accent-green));
            background-size: 200% 100%;
            animation: gradientFlow 3s ease infinite;
        }

        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .feature-box::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 50px;
            height: 50px;
            background: var(--glass-bg);
            border-radius: 50%;
            transform: translate(25px, 25px);
            transition: all 0.3s ease;
        }

        .feature-box:hover::after {
            transform: translate(15px, 15px);
        }

        .feature-icon {
            font-size: 2.8rem;
            margin-bottom: 20px;
            color: var(--dark-blue);
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
        }

        .feature-icon::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            border: 2px solid var(--accent-green);
            border-radius: 50%;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s ease;
        }

        .feature-box:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
            color: var(--accent-green);
        }

        .feature-box:hover .feature-icon::before {
            opacity: 0.3;
            transform: scale(1);
        }

        .feature-title {
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 15px;
            font-size: 1.4rem;
            position: relative;
            display: inline-block;
        }

        .feature-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-green);
            transition: width 0.3s ease;
        }

        .feature-box:hover .feature-title::after {
            width: 100%;
        }

        .feature-description {
            color: #666;
            margin-bottom: 25px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .feature-box:hover .feature-description {
            color: #444;
        }

        .feature-arrow {
            color: var(--accent-green);
            font-size: 1.2rem;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateX(-10px);
        }

        .feature-box:hover .feature-arrow {
            opacity: 1;
            transform: translateX(0);
        }

        .coming-soon {
            position: relative;
            filter: grayscale(30%);
            opacity: 0.8;
        }

        .coming-soon::after {
            content: 'COMING SOON';
            position: absolute;
            top: 10px;
            right: -25px;
            background: var(--accent-green);
            color: var(--dark-blue);
            padding: 3px 25px;
            font-size: 0.7rem;
            font-weight: 700;
            transform: rotate(45deg);
            box-shadow: var(--neon-glow);
            z-index: 2;
        }

        .user-info {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-green), #8fd41a);
            color: var(--dark-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-left: 15px;
            box-shadow: 0 0 0 3px rgba(163, 234, 42, 0.3);
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: rotate(15deg);
            box-shadow: 0 0 0 5px rgba(163, 234, 42, 0.5);
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            filter: blur(10px);
        }

        .shape-1 {
            width: 200px;
            height: 200px;
            background: var(--accent-green);
            top: 10%;
            left: -50px;
            animation: float 8s ease-in-out infinite;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            background: var(--light-blue);
            bottom: -100px;
            right: -100px;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease forwards;
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
    </div>

    <header class="dashboard-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="dashboard-title animate__animated animate__fadeInLeft"><i class="fas fa-shield-alt"></i> ADMIN PANEL</h2>
                </div>
                <div class="col-md-6">
                    <div class="user-info animate__animated animate__fadeInRight">
                        <span>Welcome, <strong>Administrator</strong></span>
                        <div class="user-avatar">
                            <i class="fas fa-user-cog"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <div class="container">
            <div class="row">
                <!-- Learn Box -->
                <div class="col-lg-4 col-md-6 mb-4 animate-fade-in-up" style="animation-delay: 0.1s;">
                    <a href="{{ route('Course.index') }}" class="text-decoration-none">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h3 class="feature-title">Learn Center</h3>
                            <p class="feature-description">Access comprehensive training materials and educational resources</p>
                            <div class="feature-arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Challenges Box -->
                <div class="col-lg-4 col-md-6 mb-4 animate-fade-in-up" style="animation-delay: 0.2s;">
                    <a href="{{ route('challenge.index') }}" class="text-decoration-none">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-gamepad"></i>
                            </div>
                            <h3 class="feature-title">Challenges</h3>
                            <p class="feature-description">Create and manage interactive challenges for users</p>
                            <div class="feature-arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Users Box -->
                <div class="col-lg-4 col-md-6 mb-4 animate-fade-in-up" style="animation-delay: 0.3s;">
                    <a href="{{ route('test.blade') }}" class="text-decoration-none">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-users-cog"></i>
                            </div>
                            <h3 class="feature-title">User Management</h3>
                            <p class="feature-description">Manage all system users and their permissions</p>
                            <div class="feature-arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Levels Box -->
                <div class="col-lg-4 col-md-6 mb-4 animate-fade-in-up" style="animation-delay: 0.4s;">
                    <a href="{{ route('level.index') }}" class="text-decoration-none">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3 class="feature-title">Level System</h3>
                            <p class="feature-description">Configure progression levels and achievements</p>
                            <div class="feature-arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Reports Box -->
                <div class="col-lg-4 col-md-6 mb-4 animate-fade-in-up" style="animation-delay: 0.4s;">
                    <a href="{{ route('challenge.reports') }}" class="text-decoration-none">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-file-alt"></i> <!-- Changed icon -->
                            </div>
                            <h3 class="feature-title">Users Reports</h3>
                            <p class="feature-description">View user statistics and performance metrics</p> <!-- Updated description -->
                            <div class="feature-arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                    </div>



                <!-- Stats Box -->
                <div class="col-lg-4 col-md-6 mb-4 animate-fade-in-up" style="animation-delay: 0.6s;">
                    <div class="feature-box" style="background: rgba(0, 26, 51, 0.7); border: 1px solid rgba(163, 234, 42, 0.3);">
                        <div class="feature-icon" style="color: var(--accent-green);">
                            <i class="fas fa-comment-dots"></i>
                        </div>
                        <h3 class="feature-title" style="color: white;">New Feature</h3>
                        <p class="feature-description" style="color: rgba(255,255,255,0.8);">Interact with users through automated conversations, answering questions and providing support instantly</p>
                        <div class="feature-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enhanced animations
        document.addEventListener('DOMContentLoaded', function() {
            // Add ripple effect to feature boxes
            document.querySelectorAll('.feature-box').forEach(box => {
                box.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    ripple.className = 'ripple-effect';
                    ripple.style.left = `${e.clientX - box.getBoundingClientRect().left}px`;
                    ripple.style.top = `${e.clientY - box.getBoundingClientRect().top}px`;
                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 1000);
                });
            });

            // Add style for ripple effect
            const style = document.createElement('style');
            style.innerHTML = `
                .ripple-effect {
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(163, 234, 42, 0.3);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    pointer-events: none;
                    width: 100px;
                    height: 100px;
                    margin-left: -50px;
                    margin-top: -50px;
                }

                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>
