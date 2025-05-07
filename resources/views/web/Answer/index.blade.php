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
    .answers-header {
        background: linear-gradient(135deg, var(--dark-blue), var(--light-blue));
        color: white;
        padding: 25px 0;
        border-bottom: 3px solid var(--accent-green);
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.4);
        margin-bottom: 40px;
    }

    .answers-title {
        font-weight: 700;
        letter-spacing: 1px;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        position: relative;
        display: inline-block;
        color: var(--accent-green);
    }

    /* Answer Card */
    .answer-card {
        background: var(--card-bg);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(163, 234, 42, 0.3);
        position: relative;
    }

    .answer-content {
        display: flex;
        flex-direction: column;
    }

    .answer-option {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--dark-blue);
    }

    .answer-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .answer-status {
        display: inline-flex;
        align-items: center;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .correct-answer {
        background: rgba(163, 234, 42, 0.2);
        color: #2e7d32;
    }

    .incorrect-answer {
        background: rgba(255, 0, 0, 0.1);
        color: #c62828;
    }

    .question-info {
        font-size: 0.9rem;
        color: #555;
        margin-top: 5px;
    }

    /* Action Buttons */
    .answer-actions {
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
    }

    .delete-btn {
        background: rgba(255, 0, 0, 0.1);
        color: #ff4444;
    }

    .delete-btn:hover {
        background: rgba(255, 0, 0, 0.2);
    }

    /* Add Answer Button */
    .add-answer-btn {
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

    .add-answer-btn:hover {
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

<header class="answers-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="answers-title"><i class="fas fa-check-circle"></i> ANSWERS MANAGEMENT</h2>
                <p class="text-white mt-2">Manage all question answers</p>
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
    <div class="row">
        <div class="col-md-12">
            @foreach ($answers as $answer)
            <div class="answer-card">
                <div class="answer-content">
                    <div class="answer-option">{{ $answer->option }}</div>

                    <div class="answer-meta">
                        <div>
                            <span class="answer-status {{ $answer->is_correct ? 'correct-answer' : 'incorrect-answer' }}">
                                <i class="fas fa-{{ $answer->is_correct ? 'check' : 'times' }} me-1"></i>
                                {{ $answer->is_correct ? 'Correct Answer' : 'Incorrect Answer' }}
                            </span>
                            @if($answer->question)
                            <div class="question-info">
                                <strong>Question:</strong> {{ Str::limit($answer->question->question, 100) }}
                            </div>
                            @endif
                        </div>

                        <div class="answer-actions">
                            <button class="action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $answer->id }}">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <form action="{{ route('answer.destroy', $answer->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete-btn">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal{{ $answer->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('answer.update', $answer->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Answer</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Option</label>
                                    <input class="form-control" name="option" type="text" value="{{ $answer->option }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Is Correct</label>
                                    <select class="form-control" name="is_correct" required>
                                        <option value="1" {{ $answer->is_correct ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !$answer->is_correct ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Question</label>
                                    <select class="form-control" name="question_id" required>
                                        @foreach ($questions as $question)
                                            <option value="{{ $question->id }}" {{ $answer->question_id == $question->id ? 'selected' : '' }}>
                                                {{ $question->question }}
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
</div>

<!-- Create Answer Button -->
<button class="add-answer-btn" data-bs-toggle="modal" data-bs-target="#createAnswerModal">
    <i class="fas fa-plus"></i>
</button>

<!-- Create Modal -->
<div class="modal fade" id="createAnswerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('answer.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Answer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Option</label>
                        <input class="form-control" name="option" type="text" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Is Correct</label>
                        <select class="form-control" name="is_correct" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Question</label>
                        <select class="form-control" name="question_id" required>
                            @foreach ($questions as $question)
                                <option value="{{ $question->id }}">{{ $question->question }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Answer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
