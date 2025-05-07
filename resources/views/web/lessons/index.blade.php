@extends('web.layout.layout')

@section('contant')
<style>
    :root {
        --dark-blue: #001a33;
        --accent-green: rgb(163, 234, 42);
        --light-blue: #003366;
        --neon-glow: 0 0 15px rgba(163, 234, 42, 0.5);
        --card-bg: rgba(255, 255, 255, 0.95);
        --modal-bg: #001a33;
    }

    /* Header Styles */
    .lessons-header {
        background: linear-gradient(135deg, var(--dark-blue), var(--light-blue));
        color: white;
        padding: 25px 0;
        border-bottom: 3px solid var(--accent-green);
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.4);
        margin-bottom: 40px;
    }

    .lessons-title {
        font-weight: 700;
        letter-spacing: 1px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        position: relative;
        display: inline-block;
        color: var(--accent-green);
    }

    /* Card Grid */
    .lessons-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
        padding: 0 20px;
    }

    /* Lesson Card */
    .lesson-card {
        background: var(--card-bg);
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        position: relative;
        border: 1px solid rgba(163, 234, 42, 0.3);
        cursor: pointer;
    }

    .lesson-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2), var(--neon-glow);
    }

    /* Image Container */
    .lesson-image-container {
        height: 180px;
        overflow: hidden;
        position: relative;
    }

    .lesson-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .lesson-card:hover .lesson-image {
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

    /* Content Area */
    .lesson-content {
        padding: 20px;
        position: relative;
    }

    .lesson-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dark-blue);
        margin-bottom: 10px;
        padding-right: 30px;
    }

    .lesson-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .topics-count {
        background: rgba(163, 234, 42, 0.1);
        color: var(--dark-blue);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    /* Action Buttons */
    .lesson-actions {
        display: flex;
        gap: 10px;
        position: relative;
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
        position: relative;
        z-index: 2;
    }

    .edit-btn {
        background: rgba(163, 234, 42, 0.2);
        color: var(--dark-blue);
    }

    .edit-btn:hover {
        background: rgba(163, 234, 42, 0.4);
    }

    .delete-btn {
        background: rgba(255, 0, 0, 0.1);
        color: #ff4444;
    }

    .delete-btn:hover {
        background: rgba(255, 0, 0, 0.2);
    }

    /* New Topics Arrow Button */
    .topics-arrow-btn {
        position: absolute;
        right: -10px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--accent-green);
        color: var(--dark-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateX(10px);
        z-index: 1;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .lesson-card:hover .topics-arrow-btn {
        opacity: 1;
        transform: translateX(0);
    }

    .topics-arrow-btn:hover {
        background: #8fd41a;
        box-shadow: 0 0 10px rgba(163, 234, 42, 0.7);
    }

    /* Add Lesson Button */
    .add-lesson-btn {
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
        font-weight: bold;
    }

    .add-lesson-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 0 20px var(--accent-green);
    }

    /* Modal Styling */
    .modal-content {
        background: var(--modal-bg);
        color: white;
        border: 1px solid var(--accent-green);
    }

    .modal-header {
        border-bottom: 1px solid var(--accent-green);
        background: rgba(0, 0, 0, 0.2);
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

    .btn-close {
        filter: invert(1);
    }
</style>

<header class="lessons-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="lessons-title"><i class="fas fa-book-open"></i> ROOMS MANAGEMENT</h2>
                <p class="text-white mt-2">Manage all your training rooms</p>
            </div>
            <div class="col-md-4 text-md-end">
                {{-- <div class="user-avatar" style="display: inline-flex; align-items: center; background: rgba(163, 234, 42, 0.2); padding: 8px 15px; border-radius: 30px;">
                    <i class="fas fa-user-circle me-2" style="color: var(--accent-green);"></i>
                    <span>{{ Auth::user()->name }}</span>
                </div> --}}
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="lessons-container">
        @foreach ($lessons as $lesson)
        <div class="lesson-card">
            <div class="lesson-image-container" onclick="window.location.href='{{ route('topic.index', $lesson->id) }}'">
                @if ($lesson->image)
                <img src="{{ asset($lesson->image) }}" alt="Lesson image" class="lesson-image">
                @else
                <div style="background: rgba(163, 234, 42, 0.1); height: 100%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-book" style="font-size: 3rem; color: rgba(163, 234, 42, 0.3);"></i>
                </div>
                @endif
                @if($lesson->course)
                <span class="course-badge">{{ $lesson->course->name }}</span>
                @endif
            </div>

            <div class="lesson-content">
                <h3 class="lesson-title" onclick="window.location.href='{{ route('topic.index', $lesson->id) }}'">{{ $lesson->name }}</h3>

                <div class="lesson-meta">
                    <span class="topics-count" onclick="window.location.href='{{ route('topic.index', $lesson->id) }}'">
                        <i class="fas fa-tasks me-1"></i> {{ $lesson->topic->count() }} Topics
                    </span>

                    <div class="lesson-actions">
                        <button class="action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $lesson->id }}" onclick="event.stopPropagation()">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <form action="{{ route('lesson.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" onclick="event.stopPropagation()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <button class="topics-arrow-btn" onclick="window.location.href='{{ route('topic.index', $lesson->id) }}'; event.stopPropagation()">
                            →
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal{{ $lesson->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('lesson.update', $lesson->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Lesson</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" name="name" value="{{ $lesson->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input class="form-control" name="image" type="file">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Course</label>
                                <select class="form-control" name="course_id" required>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}" {{ $lesson->course_id == $course->id ? 'selected' : '' }}>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Create Lesson Button -->
<button class="add-lesson-btn" data-bs-toggle="modal" data-bs-target="#createModal">
    <i class="fas fa-plus"></i>
</button>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('lesson.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Lesson</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input class="form-control" name="image" type="file">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course</label>
                        <select class="form-control" name="course_id" required>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Prevent action buttons from triggering card click
    document.querySelectorAll('.lesson-actions button, .lesson-actions form').forEach(el => {
        el.addEventListener('click', e => e.stopPropagation());
    });
</script>
@endsection
