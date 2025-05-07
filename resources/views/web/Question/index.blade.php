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
    .questions-header {
        background: linear-gradient(135deg, var(--dark-blue), var(--light-blue));
        color: white;
        padding: 25px 0;
        border-bottom: 3px solid var(--accent-green);
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.4);
        margin-bottom: 40px;
    }

    .questions-title {
        font-weight: 700;
        letter-spacing: 1px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        position: relative;
        display: inline-block;
        color: var(--accent-green);
    }

    /* Card Grid */
    .questions-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 25px;
        padding: 0 20px;
    }

    /* Question Card */
    .question-card {
        background: var(--card-bg);
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        position: relative;
        border: 1px solid rgba(163, 234, 42, 0.3);
        cursor: pointer;
    }

    .question-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2), var(--neon-glow);
    }

    /* Image Container */
    .question-image-container {
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .question-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .question-card:hover .question-image {
        transform: scale(1.05);
    }

    .topic-badge {
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

    .point-badge {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: rgba(163, 234, 42, 0.8);
        color: var(--dark-blue);
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 700;
    }

    /* Content Area */
    .question-content {
        padding: 20px;
        position: relative;
    }

    .question-text {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark-blue);
        margin-bottom: 15px;
        min-height: 60px;
    }

    .question-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .answers-count {
        background: rgba(163, 234, 42, 0.1);
        color: var(--dark-blue);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    /* Action Buttons */
    .question-actions {
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

    /* Answers Arrow Button */
    .answers-arrow-btn {
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

    .question-card:hover .answers-arrow-btn {
        opacity: 1;
        transform: translateX(0);
    }

    .answers-arrow-btn:hover {
        background: #8fd41a;
        box-shadow: 0 0 10px rgba(163, 234, 42, 0.7);
    }

    /* Add Question Button */
    .add-question-btn {
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

    .add-question-btn:hover {
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

<header class="questions-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="questions-title"><i class="fas fa-question-circle"></i> QUESTIONS MANAGEMENT</h2>
                <p class="text-white mt-2">Manage all training questions</p>
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
    <div class="questions-container">
        @foreach ($questions as $question)
        <div class="question-card" onclick="window.location.href='{{ route('answer.index') }}?question_id={{ $question->id }}'">
            <div class="question-image-container">
                @if ($question->image)
                <img src="{{ asset('storage/' . $question->image) }}" alt="Question image" class="question-image">
                @else
                <div style="background: rgba(163, 234, 42, 0.1); height: 100%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-question" style="font-size: 3rem; color: rgba(163, 234, 42, 0.3);"></i>
                </div>
                @endif
                @if($question->topic)
                <span class="topic-badge">{{ $question->topic->name }}</span>
                @endif
                <span class="point-badge">{{ $question->point }} pts</span>
            </div>

            <div class="question-content">
                <div class="question-text">{{ $question->question }}</div>

                <div class="question-meta">
                    <span class="answers-count">
                        <i class="fas fa-reply me-1"></i>
                        {{ $question->answers ? $question->answers->count() : 0 }} Answers
                    </span>

                    <div class="question-actions">
                        <button class="action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $question->id }}" onclick="event.stopPropagation()">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <form action="{{ route('question.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" onclick="event.stopPropagation()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <button class="answers-arrow-btn" onclick="window.location.href='{{ route('answer.index') }}?question_id={{ $question->id }}'; event.stopPropagation()">
                            →
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal{{ $question->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('question.update', $question->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Question</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Question</label>
                                <textarea class="form-control" name="question" required>{{ $question->question }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input class="form-control" name="image" type="file">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Points</label>
                                <input class="form-control" name="point" type="number" value="{{ $question->point }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Topic</label>
                                <select class="form-control" name="topic_id" required>
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}" {{ $question->topic_id == $topic->id ? 'selected' : '' }}>
                                            {{ $topic->name }}
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

<!-- Create Question Button -->
<button class="add-question-btn" data-bs-toggle="modal" data-bs-target="#createQuestionModal">
    <i class="fas fa-plus"></i>
</button>

<!-- Create Modal -->
<div class="modal fade" id="createQuestionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('question.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Question</label>
                        <textarea class="form-control" name="question" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input class="form-control" name="image" type="file">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Points</label>
                        <input class="form-control" name="point" type="number" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Topic</label>
                        <select class="form-control" name="topic_id" required>
                            @foreach ($topics as $topic)
                                <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Question</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Prevent action buttons from triggering card click
    document.querySelectorAll('.question-actions button, .question-actions form').forEach(el => {
        el.addEventListener('click', e => e.stopPropagation());
    });
</script>
@endsection
