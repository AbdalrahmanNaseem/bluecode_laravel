<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon">

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins.min.css">
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css">

    <style>
        :root {
            --dark-blue: #001a33;
            --darker-blue: #081f37;
            --accent-green: #a3ea2a;
            --light-green: #c1f05a;
            --light-blue: #003366;
            /* --sidebar-width: 280px; */
            --topbar-height: 100px;
            --card-glow: 0 0 15px rgba(163, 234, 42, 0.2);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--darker-blue);
            color: #ffffff;
            overflow-x: hidden;
        }

        /* Main Layout Structure */
        .wrapper {
            display: flex;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--darker-blue), var(--dark-blue));
            overflow-x: hidden; /* Prevent horizontal scroll */
        }

        .main-panel {
            flex-grow: 1;
            margin-left: var(--sidebar-width);
            background: transparent;
            overflow-x: hidden; /* Changed from auto to hidden */
            width: calc(100% - var(--sidebar-width)); /* Ensure proper width calculation */
        }

        .page-inner {
            padding: 2rem 0; /* Changed from 2rem to remove horizontal padding */
            background: transparent;
            min-height: calc(100vh - var(--topbar-height) - 60px); /* Adjust footer space */
        }

        /* Card styling - Enhanced */
        .card {
            background: rgba(0, 26, 51, 0.6);
            border: 1px solid rgba(163, 234, 42, 0.15);
            border-radius: 12px;
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
            box-shadow: var(--card-glow);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3), var(--card-glow);
            border-color: rgba(163, 234, 42, 0.3);
        }

        .card-header {
            background: linear-gradient(90deg, rgba(0, 51, 102, 0.5), transparent);
            border-bottom: 1px solid rgba(163, 234, 42, 0.1);
            padding: 1.25rem 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .card-header:after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 4px;
            height: 100%;
            background: var(--accent-green);
        }

        /* Table styling - Enhanced */
        .table {
            color: #ffffff;
            margin-bottom: 0;
        }

        .table th {
            background: linear-gradient(var(--light-blue), #002b55);
            color: white;
            font-weight: 500;
            padding: 1rem;
            border-bottom: 2px solid var(--accent-green);
        }

        .table td {
            background: rgba(0, 26, 51, 0.5);
            padding: 0.75rem 1rem;
            border-color: rgba(163, 234, 42, 0.1);
            vertical-align: middle;
        }

        .table tr:hover td {
            background: rgba(0, 51, 102, 0.3);
        }

        /* Button styling - Enhanced */
        .btn-primary {
            background-color: var(--accent-green);
            color: var(--dark-blue);
            border: none;
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            background-color: var(--light-green);
            color: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(163, 234, 42, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* Form controls - Enhanced */
        .form-control {
            background-color: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(163, 234, 42, 0.2);
            color: white;
            padding: 0.6rem 0.8rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: var(--accent-green);
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(163, 234, 42, 0.25);
        }

        /* Links - Enhanced */
        a {
            color: var(--accent-green);
            text-decoration: none;
            transition: all 0.2s ease;
            position: relative;
        }

        a:hover {
            color: var(--light-green);
        }

        a:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-green);
            transition: width 0.3s ease;
        }

        a:hover:after {
            width: 100%;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--accent-green);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--light-green);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.4s ease forwards;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .main-panel {
                margin-left: 0;
            }

            .page-inner {
                padding: 1.5rem;
            }
        }

        /* Additional adjustments for ensuring everything fits */
        .container {
            max-width: 100%;
            padding-left: 20px;
            padding-right: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('web.layout.sidebar')

        <div class="main-panel">
            @include('web.layout.nav')

            <div class="container">
                <div class="page-inner">
                    @yield('contant')
                </div>
            </div>

            @include('web.layout.footer')
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>
    <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/js/plugin/chart-circle/circles.min.js"></script>
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/js/plugin/jsvectormap/world.js"></script>
    <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="assets/js/kaiadmin.min.js"></script>
    <script src="assets/js/setting-demo.js"></script>
    <script src="assets/js/demo.js"></script>

    <script>
        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            // Add fade-in animation to cards
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('fade-in');
            });

            // Sparkline charts with theme colors
            $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
                type: "line",
                height: "70",
                width: "100%",
                lineWidth: "2",
                lineColor: "var(--accent-green)",
                fillColor: "rgba(163, 234, 42, 0.1)",
            });

            $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
                type: "line",
                height: "70",
                width: "100%",
                lineWidth: "2",
                lineColor: "#177dff",
                fillColor: "rgba(23, 125, 255, 0.1)",
            });

            $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
                type: "line",
                height: "70",
                width: "100%",
                lineWidth: "2",
                lineColor: "#ffa534",
                fillColor: "rgba(255, 165, 52, 0.1)",
            });
        });
    </script>
</body>

</html>
