<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Portal | Control Panel</title>
    <style>
        :root {
            --dark-blue: #001a33;
            --accent-green: rgb(163, 234, 42);
            --light-blue: #003366;
            --admin-red: #ff3e3e;
        }

        body {
            background-color: var(--dark-blue);
            background-image: radial-gradient(circle at 15% 50%, rgba(0, 82, 163, 0.2) 0%, transparent 25%),
                              radial-gradient(circle at 85% 30%, rgba(163, 234, 42, 0.1) 0%, transparent 25%);
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .admin-container {
            background-color: rgba(0, 26, 51, 0.9);
            border: 1px solid rgba(163, 234, 42, 0.3);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 0 30px rgba(163, 234, 42, 0.1);
            text-align: center;
            max-width: 600px;
            width: 100%;
            backdrop-filter: blur(5px);
            position: relative;
            overflow: hidden;
        }

        .admin-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--admin-red), var(--accent-green), var(--admin-red));
        }

        .admin-title {
            color: var(--accent-green);
            margin-bottom: 15px;
            font-size: 2.2rem;
            font-weight: 700;
            text-shadow: 0 0 10px rgba(163, 234, 42, 0.3);
        }

        .admin-subtitle {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 30px;
            font-size: 1rem;
        }

        .admin-warning {
            background-color: rgba(255, 62, 62, 0.15);
            border-left: 4px solid var(--admin-red);
            padding: 12px;
            margin: 25px 0;
            text-align: left;
            font-size: 0.9rem;
            border-radius: 0 5px 5px 0;
        }

        .btn-admin {
            background-color: var(--accent-green);
            color: var(--dark-blue);
            border: none;
            font-weight: 700;
            padding: 12px 30px;
            margin: 10px;
            transition: all 0.3s ease;
            border-radius: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            position: relative;
            overflow: hidden;
        }

        .btn-admin:hover {
            background-color: white;
            color: var(--dark-blue);
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(163, 234, 42, 0.5);
        }

        .btn-admin::after {
            content: 'ADMIN';
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 0.7rem;
            background-color: var(--admin-red);
            color: white;
            padding: 3px 15px;
            border-radius: 10px;
            transform: rotate(25deg);
        }

        .admin-features {
            display: flex;
            justify-content: space-around;
            margin: 30px 0;
            flex-wrap: wrap;
        }

        .feature-item {
            flex: 1;
            min-width: 120px;
            margin: 10px;
            padding: 15px;
            background-color: rgba(0, 51, 102, 0.3);
            border-radius: 8px;
            border-top: 2px solid var(--accent-green);
        }

        .feature-icon {
            color: var(--accent-green);
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .admin-footer {
            margin-top: 30px;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
            border-top: 1px solid rgba(163, 234, 42, 0.2);
            padding-top: 15px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="admin-container">
        <h1 class="admin-title"><i class="fas fa-shield-alt"></i> ADMIN PORTAL</h1>
        <p class="admin-subtitle">Control Panel for Authorized Personnel Only</p>

        <div class="admin-warning">
            <i class="fas fa-exclamation-triangle"></i> Warning: This area is restricted to authorized administrators only.
            Unauthorized access is prohibited and may be punishable by law.
        </div>

        <a href="{{ route('login') }}" class="btn btn-admin">
            <i class="fas fa-sign-in-alt"></i> Login to Dashboard
        </a>

        @if (Auth::check())
            <div class="admin-features">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div>System Settings</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>User Management</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div>Analytics</div>
                </div>
            </div>

            <a href="{{ route('test.blade') }}" class="btn btn-admin">
                <i class="fas fa-tachometer-alt"></i> Go to Dashboard
            </a>
        @endif

        <div class="admin-footer">
            <i class="fas fa-lock"></i> Secure Connection Encrypted | © 2023 Admin Panel v4.2
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
