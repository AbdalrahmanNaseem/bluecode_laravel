<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Secure Admin Portal | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --dark-blue: #001a33;
            --accent-green: rgb(163, 234, 42);
            --light-blue: #003366;
            --neon-glow: 0 0 10px rgba(163, 234, 42, 0.7);
        }

        body {
            background-color: var(--dark-blue);
            background-image:
                radial-gradient(circle at 20% 30%, rgba(0, 82, 163, 0.15) 0%, transparent 25%),
                radial-gradient(circle at 80% 70%, rgba(163, 234, 42, 0.1) 0%, transparent 25%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        .login-container {
            position: relative;
            width: 100%;
            max-width: 450px;
            perspective: 1000px;
        }

        .login-card {
            position: relative;
            transform-style: preserve-3d;
            transition: all 0.5s ease;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .card-header {
            background: linear-gradient(135deg, var(--dark-blue), var(--light-blue));
            color: white;
            text-align: center;
            padding: 25px;
            position: relative;
            border-bottom: none;
        }

        .card-header::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--accent-green), transparent);
            box-shadow: var(--neon-glow);
        }

        .card-header h3 {
            font-weight: 700;
            letter-spacing: 1px;
            margin: 0;
            text-shadow: 0 2px 5px rgba(0,0,0,0.3);
        }

        .card-body {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            backdrop-filter: blur(5px);
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 8px;
            padding: 15px 20px 15px 45px;
            border: 1px solid #ddd;
            transition: all 0.3s;
            font-size: 0.95rem;
            background-color: rgba(255,255,255,0.9);
        }

        .form-control:focus {
            border-color: var(--accent-green);
            box-shadow: 0 0 0 0.25rem rgba(163, 234, 42, 0.25);
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--dark-blue);
            opacity: 0.7;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--accent-green), rgb(140, 210, 30));
            color: var(--dark-blue);
            border: none;
            padding: 15px;
            font-weight: 700;
            letter-spacing: 1px;
            border-radius: 8px;
            transition: all 0.3s;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(163, 234, 42, 0.4);
            width: 100%;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(163, 234, 42, 0.6);
        }

        .btn-login:active {
            transform: translateY(1px);
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .remember-me label {
            margin-left: 10px;
            color: #555;
            font-weight: 500;
            cursor: pointer;
        }

        .register-link {
            color: var(--light-blue);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-block;
        }

        .register-link:hover {
            color: var(--dark-blue);
            text-decoration: underline;
            transform: translateX(5px);
        }

        .text-danger {
            color: #ff3860 !important;
            font-size: 0.9rem;
            margin-top: 5px;
            display: block;
            font-weight: 500;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            background: rgba(163, 234, 42, 0.1);
            border: 1px solid rgba(163, 234, 42, 0.2);
            border-radius: 50%;
        }

        .shape:nth-child(1) {
            width: 100px;
            height: 100px;
            top: -50px;
            right: -50px;
        }

        .shape:nth-child(2) {
            width: 150px;
            height: 150px;
            bottom: -75px;
            left: -75px;
        }

        .security-notice {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8rem;
            color: #777;
        }

        .security-notice i {
            color: var(--accent-green);
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape animate__animated animate__pulse animate__infinite animate__slow"></div>
        <div class="shape animate__animated animate__pulse animate__infinite animate__slow animate__delay-1s"></div>
    </div>

    <div class="login-container animate__animated animate__fadeIn">
        <div class="login-card">
            <div class="card-header">
                <h3><i class="fas fa-shield-alt"></i> SECURE ADMIN PORTAL</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login.custom') }}">
                    @csrf
                    <div class="form-group mb-4">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="text" placeholder="Admin Email" id="email" class="form-control"
                            name="email" required autofocus>
                    </div>

                    <div class="form-group mb-4">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" placeholder="Password" id="password" class="form-control"
                            name="password" required>
                        @if ($errors->has('emailPassword'))
                            <span class="text-danger">{{ $errors->first('emailPassword') }}</span>
                        @endif
                    </div>

                    <div class="form-group mb-4">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Keep me logged in</label>
                        </div>
                        <a href="{{ route('register-user') }}" class="register-link">
                            <i class="fas fa-user-plus"></i> Create admin account
                        </a>
                    </div>

                    <div class="d-grid mx-auto mt-4">
                        <button type="submit" class="btn btn-login">
                            <i class="fas fa-sign-in-alt"></i> ACCESS DASHBOARD
                        </button>
                    </div>
                </form>

                <div class="security-notice mt-4">
                    <i class="fas fa-lock"></i> All login activities are monitored and recorded
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginCard = document.querySelector('.login-card');

            // Add subtle tilt effect on mouse move
            document.addEventListener('mousemove', (e) => {
                const xAxis = (window.innerWidth / 2 - e.pageX) / 25;
                const yAxis = (window.innerHeight / 2 - e.pageY) / 25;
                loginCard.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
            });

            // Reset when mouse leaves
            document.addEventListener('mouseleave', () => {
                loginCard.style.transform = 'rotateY(0deg) rotateX(0deg)';
            });
        });
    </script>
</body>
</html>
