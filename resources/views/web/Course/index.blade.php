@extends('web.layout.layout')

@section('contant')
<style>
    :root {
        --dark-blue: #001a33;
        --accent-green: rgb(163, 234, 42);
        --light-blue: #003366;
        --neon-glow: 0 0 15px rgba(163, 234, 42, 0.5);
        --glass-bg: rgba(255, 255, 255, 0.1);
        --card-bg: rgba(255, 255, 255, 0.95);
    }

    .courses-header {
        background: linear-gradient(135deg, var(--dark-blue), var(--light-blue));
        color: white;
        padding: 25px 0;
        border-bottom: 3px solid var(--accent-green);
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.4);
        margin-bottom: 40px;
    }

    .courses-title {
        font-weight: 700;
        letter-spacing: 1px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        position: relative;
        display: inline-block;
        color: var(--accent-green);
    }

    .courses-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--accent-green);
        transform: scaleX(1);
    }

    .course-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        padding: 0 20px;
    }

    .course-card {
        background: var(--card-bg);
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        position: relative;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .course-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2), var(--neon-glow);
    }

    .course-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--accent-green), var(--light-blue));
    }

    .course-image-container {
        height: 180px;
        overflow: hidden;
        position: relative;
    }

    .course-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .course-card:hover .course-image {
        transform: scale(1.05);
    }

    .course-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0, 0, 0, 0.7);
        color: var(--accent-green);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .course-content {
        padding: 20px;
    }

    .course-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dark-blue);
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .course-description {
        color: #666;
        font-size: 0.95rem;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .course-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .lessons-count {
        background: rgba(0, 82, 163, 0.1);
        color: var(--dark-blue);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .course-actions {
        display: flex;
        gap: 10px;
    }

    .action-btn {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .edit-btn {
        background: rgba(163, 234, 42, 0.2);
        color: var(--dark-blue);
    }

    .edit-btn:hover {
        background: rgba(163, 234, 42, 0.4);
        transform: rotate(15deg);
    }

    .delete-btn {
        background: rgba(255, 0, 0, 0.1);
        color: #ff4444;
    }

    .delete-btn:hover {
        background: rgba(255, 0, 0, 0.2);
        transform: rotate(15deg);
    }

    .add-course-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--accent-green);
        color: var(--dark-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        z-index: 100;
        border: none;
        transition: all 0.3s;
    }

    .add-course-btn:hover {
        transform: scale(1.1) rotate(90deg);
        box-shadow: 0 0 20px var(--accent-green);
    }

    /* Modal styling to match theme */
    .modal-content {
        background: var(--dark-blue);
        border: 1px solid var(--accent-green);
        border-radius: 15px;
        overflow: hidden;
    }

    .modal-header {
        border-bottom: 1px solid var(--accent-green);
        background: rgba(0, 0, 0, 0.2);
        color: white;
    }

    .modal-footer {
        border-top: 1px solid var(--accent-green);
        background: rgba(0, 0, 0, 0.2);
    }

    .btn-primary {
        background: var(--accent-green);
        color: var(--dark-blue);
        border: none;
        font-weight: 600;
    }

    .btn-primary:hover {
        background: #8fd41a;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(163, 234, 42, 0.3);
        color: white;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.2);
        border-color: var(--accent-green);
        color: white;
        box-shadow: 0 0 0 0.25rem rgba(163, 234, 42, 0.25);
    }

    /* Floating animation for cards */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }

    .course-card {
        animation: float 6s ease-in-out infinite;
    }

    .course-card:nth-child(1) { animation-delay: 0s; }
    .course-card:nth-child(2) { animation-delay: 0.5s; }
    .course-card:nth-child(3) { animation-delay: 1s; }
    .course-card:nth-child(4) { animation-delay: 1.5s; }
    .course-card:nth-child(5) { animation-delay: 2s; }
    .course-card:nth-child(6) { animation-delay: 2.5s; }

    .course-card:hover {
        animation-play-state: paused;
    }
</style>

<header class="courses-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="courses-title"><i class="fas fa-graduation-cap"></i> MODULES MANAGEMENT</h2>
                <p class="text-white mt-2">Manage all your training materials in one place</p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="col-md-4 text-end">  <!-- Changed from text-md-end to text-md-start -->
                    {{-- <div class="user-avatar" style="display: inline-flex; align-items: center; background: rgba(163, 234, 42, 0.2); padding: 1px 15px; border-radius: 30px;">
                        <i class="fas fa-user-circle me-2" style="color: var(--accent-green); font-size: 1.2rem;"></i>
                        <span style="color: white;">{{ Auth::user()->name }}</span>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="course-grid">
        @foreach ($courses as $course)
        <div class="course-card">
            <div class="course-image-container">
                @if ($course->image)
                <img src="{{ asset($course->image) }}" alt="Course image" class="course-image">
                @else
                <div style="background: rgba(163, 234, 42, 0.1); height: 100%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-book-open" style="font-size: 3rem; color: rgba(163, 234, 42, 0.3);"></i>
                </div>
                @endif
                <span class="course-badge">{{ $course->type }}</span>
            </div>

            <div class="course-content">
                <h3 class="course-title">{{ $course->name }}</h3>
                <p class="course-description">{{ $course->description }}</p>

                <div class="course-meta">
                    <span class="lessons-count">
                        <i class="fas fa-list-ol me-1"></i> {{ $course->lessons->count() }} {{ Str::plural('Lesson', $course->lessons->count()) }}
                    </span>

                    <div class="course-actions">
                        <button class="action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $course->id }}">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <form action="{{ route('Course.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <a href="{{ route('lesson.index', $course->id) }}" class="action-btn" style="background: rgba(0, 82, 163, 0.1); color: var(--dark-blue); text-decoration: none;">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal{{ $course->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('Course.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Course: {{ $course->name }}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Course Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $course->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3" required>{{ $course->description }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Course Type</label>
                                    <select class="form-control" name="type" required>
                                        <option value="Core Modules" {{ $course->type == 'Core Modules' ? 'selected' : '' }}>Core Modules</option>
                                        <option value="Learn Module" {{ $course->type == 'Learn Module' ? 'selected' : '' }}>Learn Module</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Course Image</label>
                                    <input type="file" class="form-control" name="image">
                                    @if($course->image)
                                    <small class="text-muted">Current image will be replaced</small>
                                    @endif
                                </div>
                            </div>
                            @if($course->image)
                            <div class="mb-3">
                                <label class="form-label">Current Image</label>
                                <div>
                                    <img src="{{ asset($course->image) }}" alt="Current course image" style="max-width: 200px; max-height: 150px; border-radius: 5px;">
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Create Course Button -->
<button class="add-course-btn" data-bs-toggle="modal" data-bs-target="#createModal">
    <i class="fas fa-plus"></i>
</button>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('Course.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create New Course</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Course Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Course Type</label>
                            <select class="form-control" name="type" required>
                                <option value="Core Modules">Core Modules</option>
                                <option value="Learn Module">Learn Module</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Course Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Course</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Make sure clicks on action buttons don't trigger card click
    document.querySelectorAll('.course-actions button, .course-actions a, .course-actions form').forEach(element => {
        element.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });

    // Add hover effect for cards
    document.querySelectorAll('.course-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.zIndex = '10';
        });

        card.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
        });
    });
</script>
@endsection
