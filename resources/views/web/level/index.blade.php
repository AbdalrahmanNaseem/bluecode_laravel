@extends('web.layout.layout')

@section('contant')
<style>
    :root {
        --dark-blue: #001a33;
        --accent-green: rgb(163, 234, 42);
        --light-blue: #003366;
    }

    .card-round {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-round:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        background: linear-gradient(135deg, var(--dark-blue), var(--light-blue));
        color: white;
        padding: 18px 25px;
        border-bottom: 3px solid var(--accent-green);
    }

    .card-title {
        font-weight: 600;
        margin: 0;
        font-size: 1.2rem;
    }

    .btn-success {
        background-color: var(--accent-green);
        border: none;
        color: var(--dark-blue);
        font-weight: 600;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px !important;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: rgb(140, 210, 30);
        transform: rotate(90deg);
    }

    .table-responsive {
        border-radius: 0 0 12px 12px;
        overflow: hidden;
    }

    .thead-light {
        background-color: #f8fafc;
    }

    .thead-light th {
        font-weight: 600;
        color: var(--dark-blue);
        padding: 15px;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
    }

    tbody tr {
        transition: all 0.2s ease;
    }

    tbody tr:hover {
        background-color: #f8fafc;
    }

    tbody td {
        padding: 15px;
        vertical-align: middle;
        border-top: 1px solid #f1f5f9;
    }

    .btn-sm {
        padding: 0.35rem 0.7rem;
        font-size: 0.8rem;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-warning {
        background-color: #f59e0b;
        color: white;
    }

    .btn-warning:hover {
        background-color: #d97706;
        transform: translateY(-2px);
    }

    .btn-danger {
        background-color: #ef4444;
    }

    .btn-danger:hover {
        background-color: #dc2626;
        transform: translateY(-2px);
    }

    .modal-content {
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        background: linear-gradient(135deg, var(--dark-blue), var(--light-blue));
        color: white;
        border-bottom: 3px solid var(--accent-green);
        padding: 18px 20px;
    }

    .modal-title {
        font-weight: 600;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px 15px;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--accent-green);
        box-shadow: 0 0 0 0.2rem rgba(163, 234, 42, 0.25);
    }

    label {
        font-weight: 500;
        color: var(--dark-blue);
        margin-bottom: 6px;
        display: block;
    }

    .btn-primary {
        background-color: var(--dark-blue);
        border: none;
    }

    .btn-primary:hover {
        background-color: #000d1a;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    /* Animation for table rows */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    tbody tr {
        animation: fadeIn 0.4s ease forwards;
        opacity: 0;
    }

    tbody tr:nth-child(1) { animation-delay: 0.1s; }
    tbody tr:nth-child(2) { animation-delay: 0.2s; }
    tbody tr:nth-child(3) { animation-delay: 0.3s; }
    tbody tr:nth-child(4) { animation-delay: 0.4s; }
    tbody tr:nth-child(5) { animation-delay: 0.5s; }
</style>

<div class="pt-2 pb-4 d-flex align-items-left align-items-md-center flex-column flex-md-row">
    <div>
        <h3 class="mb-3 fw-bold">Dashboard</h3>
        <h6 class="mb-2 op-7">{{ Auth::user()->name }}</h6>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-round">
            <div class="card-header">
                <div class="card-head-row card-tools-still-right d-flex justify-content-between align-items-center">
                    <div class="card-title">All Level Info</div>

                    <div>
                        <button data-bs-toggle="modal" data-bs-target="#createModal"
                            class="btn btn-success d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px; border-radius: 10 px;">
                            <i class="text-white bi bi-plus" style="font-size: 25px;"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="p-0 card-body">
                <div class="table-responsive">
                    <table class="table mb-0 align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">id</th>
                                <th scope="col" class="text-center">name</th>
                                <th scope="col" class="text-center">start</th>
                                <th scope="col" class="text-center">end</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($levels as $level)
                            <tr>
                                <td class="text-center">{{ $level->id }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill">
                                        {{ $level->name }}
                                    </span>
                                </td>
                                <td class="text-center fw-bold text-success">{{ $level->start }}</td>
                                <td class="text-center fw-bold text-danger">{{ $level->end }}</td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $level->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <form action="{{ route('level.destroy', $level->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this level?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $level->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel{{ $level->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('level.update', $level->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editModalLabel{{ $level->id }}">Edit Level</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="name">Name</label>
                                                            <input class="form-control" name="name" type="text"
                                                                value="{{ $level->name }}">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="start">Start Point</label>
                                                            <input class="form-control" name="start" type="number"
                                                                value="{{ $level->start }}">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="end">End Point</label>
                                                            <input class="form-control" name="end" type="number"
                                                                value="{{ $level->end }}">
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create New Level</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('level.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input class="form-control" name="name" type="text" required>
                    </div>

                    <div class="mb-3">
                        <label for="start">Start Point</label>
                        <input class="form-control" name="start" type="number" required>
                    </div>

                    <div class="mb-3">
                        <label for="end">End Point</label>
                        <input class="form-control" name="end" type="number" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Add animation to modal show
    document.addEventListener('DOMContentLoaded', function() {
        // Add ripple effect to buttons
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                ripple.classList.add('ripple-effect');

                const rect = button.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add the ripple effect style
        const style = document.createElement('style');
        style.innerHTML = `
            .ripple-effect {
                position: absolute;
                border-radius: 50%;
                background-color: rgba(255, 255, 255, 0.7);
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
                width: 20px;
                height: 20px;
                margin-left: -10px;
                margin-top: -10px;
            }

            @keyframes ripple {
                to {
                    transform: scale(10);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    });
</script>
@endsection
