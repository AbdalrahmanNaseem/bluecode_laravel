@extends('web.layout.layout')

@section('contant')
<style>
    /* Enhanced Dashboard Styles with Space Theme */
    :root {
        --primary-dark: #0A1128;
        --primary-medium: #1C3144;
        --accent-green: #A3EA2A;
        --accent-blue: #4ECDC4;
        --accent-purple: #7B68EE;
        --text-light: #F8F9FA;
    }

    /* Dashboard Base */
    body {
        background-color: var(--primary-dark);
        background-image:
            radial-gradient(circle at 10% 20%, rgba(74, 128, 245, 0.03) 0%, transparent 20%),
            radial-gradient(circle at 90% 60%, rgba(163, 234, 42, 0.03) 0%, transparent 30%);
        background-attachment: fixed;
    }

    /* Dashboard Header */
    .dashboard-header {
        background: linear-gradient(135deg, #1a237e, #0d47a1);
        padding: 2.5rem;
        border-radius: 20px;
        margin-bottom: 3rem;
        border-left: 6px solid var(--accent-green);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2), 0 0 15px rgba(163, 234, 42, 0.2);
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(163, 234, 42, 0.05) 0%, transparent 50%);
        animation: pulse 15s infinite linear;
    }

    @keyframes pulse {
        0% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.2); opacity: 0.3; }
        100% { transform: scale(1); opacity: 0.5; }
    }

    .dashboard-title {
        font-family: 'Inter', sans-serif;
        font-weight: 800;
        color: var(--text-light);
        font-size: 2.8rem;
        letter-spacing: 1px;
        position: relative;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .dashboard-title:after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 0;
        width: 80px;
        height: 4px;
        background: var(--accent-green);
        box-shadow: 0 0 15px var(--accent-green);
    }

    .user-greeting {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.3rem;
        font-weight: 500;
        margin-top: 1rem;
        display: flex;
        align-items: center;
    }

    .user-greeting::before {
        content: '●';
        color: var(--accent-green);
        margin-right: 10px;
        animation: blink 2s infinite;
    }

    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.3; }
    }

    /* Glass Cards */
    .user-card {
        background: rgba(10, 17, 40, 0.8);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(163, 234, 42, 0.2);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2), 0 0 30px rgba(163, 234, 42, 0.1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        overflow: hidden;
    }

    .user-card:hover {
        transform: translateY(-12px) scale(1.01);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25), 0 0 40px rgba(163, 234, 42, 0.15);
        border-color: rgba(163, 234, 42, 0.5);
    }

    /* Card Header */
    .card-header-custom {
        background: linear-gradient(90deg, rgba(26, 35, 126, 0.9), rgba(13, 71, 161, 0.7));
        border-bottom: 2px solid rgba(163, 234, 42, 0.3);
        padding: 1.8rem;
        position: relative;
        overflow: hidden;
    }

    .card-header-custom::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='rgba(255, 255, 255, 0.03)' fill-opacity='0.5' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.5;
    }

    .card-title-custom {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        color: var(--text-light);
        font-size: 1.6rem;
        letter-spacing: 0.5px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 1;
    }

    .total-users-badge {
        background: rgba(74, 20, 140, 0.3);
        border: 1px solid rgba(123, 104, 238, 0.4);
        color: var(--accent-purple);
        padding: 0.6rem 1.2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .total-users-badge:hover {
        background: rgba(74, 20, 140, 0.4);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .total-users-badge i {
        font-size: 1.1rem;
        margin-right: 8px;
        color: var(--accent-purple);
    }

    /* User Table */
    .user-table {
        color: var(--text-light);
        margin-bottom: 0;
    }

    .user-table thead th {
        background: linear-gradient(135deg, #1a237e, #0d47a1);
        color: var(--text-light);
        font-weight: 600;
        padding: 1.3rem;
        border-bottom: 2px solid var(--accent-green);
        text-transform: uppercase;
        font-size: 0.95rem;
        letter-spacing: 1px;
        position: relative;
    }

    .user-table thead th::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg,
            transparent,
            rgba(163, 234, 42, 0.7),
            transparent);
    }

    .user-table tbody td {
        background: rgba(10, 17, 40, 0.5);
        padding: 1.2rem;
        border-color: rgba(163, 234, 42, 0.1);
        vertical-align: middle;
        transition: all 0.3s ease;
    }

    .user-table tbody tr {
        position: relative;
        transition: all 0.3s ease;
    }

    .user-table tbody tr:hover td {
        background: rgba(26, 35, 126, 0.3);
    }

    .user-table tbody tr:hover {
        transform: scale(1.01);
        z-index: 1;
    }

    /* Level Badge */
    .level-badge {
        display: inline-block;
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        background: linear-gradient(135deg, rgba(163, 234, 42, 0.15), rgba(78, 205, 196, 0.15));
        color: var(--accent-green);
        border: 1px solid rgba(163, 234, 42, 0.3);
        box-shadow: 0 4px 15px rgba(163, 234, 42, 0.1);
        transition: all 0.3s ease;
    }

    .user-table tbody tr:hover .level-badge {
        background: linear-gradient(135deg, rgba(163, 234, 42, 0.25), rgba(78, 205, 196, 0.25));
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(163, 234, 42, 0.2);
    }

    .points-display {
        font-weight: 700;
        color: var(--accent-green);
        text-shadow: 0 0 10px rgba(163, 234, 42, 0.3);
        transition: all 0.3s ease;
    }

    .user-table tbody tr:hover .points-display {
        color: #b8f555;
        text-shadow: 0 0 15px rgba(163, 234, 42, 0.5);
    }

    /* Avatar Style */
    .avatar-sm {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        border: 2px solid rgba(163, 234, 42, 0.3);
        transition: all 0.3s ease;
    }

    .user-table tbody tr:hover .avatar-sm {
        border-color: var(--accent-green);
        transform: scale(1.1);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25), 0 0 8px rgba(163, 234, 42, 0.4);
    }

    .avatar-initials {
        width: 40px;
        height: 40px;
        background: rgba(163, 234, 42, 0.2) !important;
        color: var(--accent-green) !important;
        font-weight: 600;
        font-size: 1.2rem;
        border: 2px solid rgba(163, 234, 42, 0.3);
        transition: all 0.3s ease;
    }

    .user-table tbody tr:hover .avatar-initials {
        background: rgba(163, 234, 42, 0.3) !important;
        border-color: var(--accent-green);
        transform: scale(1.1);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25), 0 0 8px rgba(163, 234, 42, 0.4);
    }

    /* Buttons */
    .btn-outline-accent {
        color: var(--accent-green);
        border: 1px solid var(--accent-green);
        background: rgba(163, 234, 42, 0.05);
        border-radius: 50px;
        padding: 0.6rem 1rem;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .btn-outline-accent:hover {
        background: var(--accent-green);
        color: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(163, 234, 42, 0.3);
    }

    .btn-outline-accent i {
        transition: all 0.3s ease;
    }

    .btn-outline-accent:hover i {
        transform: scale(1.2);
    }

    /* Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .user-table tbody tr {
        opacity: 0;
        animation: fadeIn 0.6s ease forwards;
    }

    .user-table tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .user-table tbody tr:nth-child(2) { animation-delay: 0.2s; }
    .user-table tbody tr:nth-child(3) { animation-delay: 0.3s; }
    .user-table tbody tr:nth-child(4) { animation-delay: 0.4s; }
    .user-table tbody tr:nth-child(5) { animation-delay: 0.5s; }
    .user-table tbody tr:nth-child(6) { animation-delay: 0.6s; }
    .user-table tbody tr:nth-child(7) { animation-delay: 0.7s; }
    .user-table tbody tr:nth-child(8) { animation-delay: 0.8s; }
    .user-table tbody tr:nth-child(9) { animation-delay: 0.9s; }
    .user-table tbody tr:nth-child(10) { animation-delay: 1s; }

    /* Floating particles */
    .particles-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        overflow: hidden;
        z-index: -1;
        pointer-events: none;
    }

    .particle {
        position: absolute;
        width: 3px;
        height: 3px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        animation: float 15s infinite linear;
    }

    @keyframes float {
        0% {
            transform: translateY(0) translateX(0);
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            transform: translateY(-100vh) translateX(100px);
            opacity: 0;
        }
    }

    /* Stats Cards */
    .stats-row {
        margin-bottom: 3rem;
    }

    .stats-card {
        background: rgba(10, 17, 40, 0.8);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        border: 1px solid rgba(163, 234, 42, 0.2);
        padding: 1.5rem;
        height: 100%;
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }

    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        border-color: rgba(163, 234, 42, 0.4);
    }

    .stats-card::before {
        content: '';
        position: absolute;
        width: 150%;
        height: 150%;
        background: radial-gradient(circle, rgba(163, 234, 42, 0.1) 0%, transparent 70%);
        top: -25%;
        left: -25%;
        opacity: 0;
        transition: opacity 0.6s ease;
    }

    .stats-card:hover::before {
        opacity: 1;
    }

    .stats-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, var(--accent-green), var(--accent-blue));
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }

    .stats-title {
        color: var(--text-light);
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .stats-value {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--text-light);
        margin-bottom: 0.5rem;
    }

    .stats-trend {
        display: flex;
        align-items: center;
        font-size: 0.9rem;
    }

    .trend-up {
        color: var(--accent-green);
    }

    .trend-down {
        color: #ff6b6b;
    }

    .stats-trend i {
        margin-right: 5px;
    }
</style>

<!-- Floating particles background -->
<div class="particles-container">
    @for ($i = 0; $i < 30; $i++)
        <div class="particle" style="
            left: {{ rand(1, 100) }}%;
            top: {{ rand(1, 100) }}vh;
            width: {{ rand(1, 4) }}px;
            height: {{ rand(1, 4) }}px;
            opacity: {{ rand(1, 10) / 10 }};
            animation-duration: {{ rand(10, 30) }}s;
            animation-delay: -{{ rand(0, 20) }}s;
        "></div>
    @endfor
</div>

<div class="dashboard-header">
    <h3 class="dashboard-title">Cosmic User Analytics</h3>
    <h6 class="user-greeting mt-3">Welcome back, {{ Auth::user()->name }}</h6>
</div>


            <div class="p-0 card-body">
                <div class="table-responsive">
                    <table class="user-table table align-items-center">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">User</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Points</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allUsers as $allUser)
                            <tr>
                                <td class="text-center">#{{ $allUser->id }}</td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        @if($allUser->profile_photo_path)
                                            <img src="{{ asset('storage/'.$allUser->profile_photo_path) }}"
                                                class="avatar-sm me-2">
                                        @else
                                            <div class="avatar-initials me-2 d-flex align-items-center justify-content-center">
                                                {{ substr($allUser->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <span>{{ $allUser->name }}</span>
                                    </div>
                                </td>
                                <td class="text-center">{{ $allUser->email }}</td>
                                <td class="text-center points-display">{{ $allUser->points }}</td>
                                <td class="text-center">
                                    <span class="level-badge">{{ $allUser->level_name }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-accent me-2">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-accent">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Add a simple animation when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        const dashboardHeader = document.querySelector('.dashboard-header');
        dashboardHeader.style.opacity = '0';
        dashboardHeader.style.transform = 'translateY(20px)';

        setTimeout(() => {
            dashboardHeader.style.transition = 'all 0.8s ease';
            dashboardHeader.style.opacity = '1';
            dashboardHeader.style.transform = 'translateY(0)';
        }, 300);
    });
</script>
@endsection
