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
    .topics-header {
        background: linear-gradient(135deg, var(--dark-blue), var(--light-blue));
        color: white;
        padding: 25px 0;
        border-bottom: 3px solid var(--accent-green);
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.4);
        margin-bottom: 40px;
    }

    .topics-title {
        font-weight: 700;
        letter-spacing: 1px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        position: relative;
        display: inline-block;
        color: var(--accent-green);
    }

    /* Card Grid */
    .topics-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
        padding: 0 20px;
    }

    /* Topic Card */
    .topic-card {
        background: var(--card-bg);
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        position: relative;
        border: 1px solid rgba(163, 234, 42, 0.3);
        cursor: pointer;
    }

    .topic-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2), var(--neon-glow);
    }

    /* Image Container */
    .topic-image-container {
        height: 180px;
        overflow: hidden;
        position: relative;
    }

    .topic-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .topic-card:hover .topic-image {
        transform: scale(1.05);
    }

    .lesson-badge {
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
    .topic-content {
        padding: 20px;
        position: relative;
    }

    .topic-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dark-blue);
        margin-bottom: 10px;
        padding-right: 30px;
    }

    .topic-subject {
        color: #555;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .topic-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .questions-count {
        background: rgba(163, 234, 42, 0.1);
        color: var(--dark-blue);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    /* Action Buttons */
    .topic-actions {
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

    /* Questions Arrow Button */
    .questions-arrow-btn {
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

    .topic-card:hover .questions-arrow-btn {
        opacity: 1;
        transform: translateX(0);
    }

    .questions-arrow-btn:hover {
        background: #8fd41a;
        box-shadow: 0 0 10px rgba(163, 234, 42, 0.7);
    }

    /* Add Topic Button */
    .add-topic-btn {
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

    .add-topic-btn:hover {
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

<header class="topics-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="topics-title"><i class="fas fa-layer-group"></i> TASKS MANAGEMENT</h2>
                <p class="text-white mt-2">Manage all your training tasks</p>
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
    <div class="topics-container">
        @foreach ($topics as $topic)
        <div class="topic-card" onclick="window.location.href='{{ url('/question') }}?topic_id={{ $topic->id }}'">
            <div class="topic-image-container">
                @if ($topic->image)
                <img src="{{ asset('storage/' . $topic->image) }}" alt="Topic image" class="topic-image">
                @else
                <div style="background: rgba(163, 234, 42, 0.1); height: 100%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-layer-group" style="font-size: 3rem; color: rgba(163, 234, 42, 0.3);"></i>
                </div>
                @endif
                @if($topic->lesson)
                <span class="lesson-badge">{{ $topic->lesson->name }}</span>
                @endif
            </div>

            <div class="topic-content">
                <h3 class="topic-title">{{ $topic->name }}</h3>
                <p class="topic-subject">{{ $topic->supject }}</p>

                <div class="topic-meta">
                    <span class="questions-count">
                        <i class="fas fa-question-circle me-1"></i>
                        {{ $topic->questions ? $topic->questions->count() : 0 }} Questions
                    </span>

                    <div class="topic-actions">
                        <button class="action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $topic->id }}" onclick="event.stopPropagation()">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <form action="{{ route('topic.destroy', $topic->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" onclick="event.stopPropagation()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <button class="questions-arrow-btn" onclick="window.location.href='{{ url('/question') }}?topic_id={{ $topic->id }}'; event.stopPropagation()">
                            →
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal{{ $topic->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('topic.update', $topic->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Topic</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" name="name" value="{{ $topic->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Subject</label>
                                <textarea class="form-control" name="supject" required>{{ $topic->supject }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input class="form-control" name="image" type="file">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lesson</label>
                                <select class="form-control" name="lesson_id" required>
                                    @foreach ($lessons as $lesson)
                                        <option value="{{ $lesson->id }}" {{ $topic->lesson_id == $lesson->id ? 'selected' : '' }}>
                                            {{ $lesson->name }}
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

<!-- Create Topic Button -->
<button class="add-topic-btn" data-bs-toggle="modal" data-bs-target="#createModal">
    <i class="fas fa-plus"></i>
</button>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('topic.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Topic</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <textarea class="form-control" name="supject" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input class="form-control" name="image" type="file">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lesson</label>
                        <select class="form-control" name="lesson_id" required>
                            @foreach ($lessons as $lesson)
                                <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
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
    document.querySelectorAll('.topic-actions button, .topic-actions form').forEach(el => {
        el.addEventListener('click', e => e.stopPropagation());
    });
</script>
@endsection
