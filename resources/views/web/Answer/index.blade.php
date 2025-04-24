@extends('layout.layout')

@section('contant')
    <div class="pt-2 pb-4 d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h3 class="mb-3 fw-bold">Answers Dashboard</h3>
            <h6 class="mb-2 op-7">{{ Auth::user()->name }}</h6>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right d-flex justify-content-between align-items-center">
                        <div class="card-title">All Answers</div>
                        <button data-bs-toggle="modal" data-bs-target="#createAnswerModal"
                            class="btn btn-success d-flex align-items-center justify-content-center"
                            style="width: 40px; height: 40px; border-radius: 10px;">
                            <i class="text-white bi bi-plus" style="font-size: 25px;"></i>
                        </button>
                    </div>
                </div>

                <div class="p-0 card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Option</th>
                                    <th class="text-center">Is Correct?</th>
                                    <th class="text-center">Question</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($answers as $answer)
                                    <tr>
                                        <td class="text-center">{{ $answer->id }}</td>
                                        <td class="text-center">{{ $answer->option }}</td>
                                        <td class="text-center">
                                            <span class="badge {{ $answer->is_correct ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $answer->is_correct ? 'Yes' : 'No' }}
                                            </span>
                                        </td>
                                        <td class="text-center">{{ $answer->question->question ?? '—' }}</td>
                                        <td class="text-center">
                                            <div class="row justify-content-center">
                                                <div class="col-auto">
                                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $answer->id }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </div>
                                                <div class="col-auto">
                                                    <form action="{{ route('answer.destroy', $answer->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" type="submit">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal{{ $answer->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('answer.update', $answer->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Answer</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label>Option</label>
                                                        <input class="form-control" name="option" type="text"
                                                            value="{{ $answer->option }}"><br>

                                                        <label>Is Correct</label>
                                                        <select class="form-control" name="is_correct">
                                                            <option value="1"
                                                                {{ $answer->is_correct ? 'selected' : '' }}>Yes</option>
                                                            <option value="0"
                                                                {{ !$answer->is_correct ? 'selected' : '' }}>No</option>
                                                        </select><br>

                                                        <label>Question</label>
                                                        <select class="form-control" name="question_id">
                                                            @foreach ($questions as $question)
                                                                <option value="{{ $question->id }}"
                                                                    {{ $answer->question_id == $question->id ? 'selected' : '' }}>
                                                                    {{ $question->question }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Answer Modal -->
    <div class="modal fade" id="createAnswerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('answer.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Answer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label>Option</label>
                        <input class="form-control" name="option" type="text"><br>

                        <label>Is Correct</label>
                        <select class="form-control" name="is_correct">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select><br>

                        <label>Question</label>
                        <select class="form-control" name="question_id">
                            @foreach ($questions as $question)
                                <option value="{{ $question->id }}">{{ $question->question }}</option>
                            @endforeach
                        </select><br>
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
