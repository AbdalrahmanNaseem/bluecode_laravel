<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Registration | Secure Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --dark-blue: #001a33;
            --accent-green: rgb(163, 234, 42);
            --light-blue: #003366;
            --neon-glow: 0 0 10px rgba(163, 234, 42, 0.5);
        }

        body {
            background-color: var(--dark-blue);
            background-image:
                radial-gradient(circle at 10% 20%, rgba(0, 82, 163, 0.2) 0%, transparent 25%),
                radial-gradient(circle at 90% 80%, rgba(163, 234, 42, 0.15) 0%, transparent 25%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .signup-form {
            width: 100%;
            max-width: 500px;
            animation: fadeInUp 0.8s ease;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.95);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .card-header {
            background: linear-gradient(135deg, var(--dark-blue), var(--light-blue));
            color: white;
            text-align: center;
            padding: 25px;
            border-bottom: 3px solid var(--accent-green);
            position: relative;
        }

        .card-header h3 {
            font-weight: 700;
            letter-spacing: 1px;
            margin: 0;
            text-shadow: 0 2px 5px rgba(0,0,0,0.3);
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--accent-green), transparent);
            box-shadow: var(--neon-glow);
        }

        .card-body {
            padding: 30px;
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

        .btn-register {
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

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(163, 234, 42, 0.6);
        }

        .checkbox label {
            display: flex;
            align-items: center;
            color: #555;
            font-weight: 500;
        }

        .checkbox input {
            margin-right: 10px;
            accent-color: var(--accent-green);
        }

        .text-danger {
            color: #ff3860 !important;
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
            font-weight: 500;
        }

        .form-stepper {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
            position: relative;
            color: #777;
        }

        .step.active {
            background-color: var(--accent-green);
            color: var(--dark-blue);
        }

        .step::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 2px;
            background-color: #ddd;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
        }

        .step:last-child::after {
            display: none;
        }

        .security-badge {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8rem;
            color: #777;
        }

        .security-badge i {
            color: var(--accent-green);
            margin-right: 5px;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .animate-pulse {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body>
    <main class="signup-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card animate__animated animate__fadeInUp">
                        <div class="card-header">
                            <h3><i class="fas fa-user-shield"></i> ADMIN REGISTRATION</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-stepper">
                                <div class="step active">1</div>
                                <div class="step">2</div>
                                <div class="step">3</div>
                            </div>

                            <form action="{{ route('register.custom') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <i class="fas fa-user input-icon"></i>
                                    <input type="text" placeholder="Username" id="name" class="form-control"
                                        name="name" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <i class="fas fa-id-card input-icon"></i>
                                    <input type="text" placeholder="Full Name" id="FullName" class="form-control"
                                        name="FullName" required>
                                    @if ($errors->has('FullName'))
                                        <span class="text-danger">{{ $errors->first('FullName') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <i class="fas fa-phone input-icon"></i>
                                    <input type="text" placeholder="Phone Number" id="phone" class="form-control"
                                        name="phone" required>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <i class="fas fa-globe input-icon"></i>
                                    <input type="text" placeholder="Country" id="country" class="form-control"
                                        name="country" required>
                                    @if ($errors->has('country'))
                                        <span class="text-danger">{{ $errors->first('country') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <i class="fas fa-envelope input-icon"></i>
                                    <input type="text" placeholder="Email Address" id="email_address" class="form-control"
                                        name="email" required>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" placeholder="Password" id="password" class="form-control"
                                        name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> I agree to terms and conditions
                                        </label>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-register animate-pulse">
                                        <i class="fas fa-user-plus"></i> CREATE ADMIN ACCOUNT
                                    </button>
                                </div>
                            </form>

                            <div class="security-badge">
                                <i class="fas fa-lock"></i> All data is encrypted and securely stored
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add focus effects to form inputs
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('.input-icon').style.color = 'var(--accent-green)';
                this.parentElement.querySelector('.input-icon').style.opacity = '1';
            });

            input.addEventListener('blur', function() {
                this.parentElement.querySelector('.input-icon').style.color = 'var(--dark-blue)';
                this.parentElement.querySelector('.input-icon').style.opacity = '0.7';
            });
        });
    </script>
</body>
</html>
