@extends('web.layout.layout')

@section('contant')
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
                        <div class="card-title">All Questions</div>
                        <button data-bs-toggle="modal" data-bs-target="#createQuestionModal"
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
                                    <th class="text-center">Question</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Point</th>
                                    <th class="text-center">Topic</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td class="text-center">{{ $question->id }}</td>
                                        <td class="text-center">{{ $question->question }}</td>
                                        <td class="text-center">
                                            @if ($question->image)
                                                <img src="{{ asset('storage/' . $question->image) }}" alt="question image"
                                                    width="50">
                                            @else
                                                <span class="text-muted">No image</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $question->point }}</td>
                                        <td class="text-center">{{ $question->topic->name ?? '—' }}</td>
                                        <td class="text-center">
                                            <div class="row justify-content-center">
                                                <div class="col-auto">
                                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $question->id }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </div>
                                                <div class="col-auto">
                                                    <form action="{{ route('question.destroy', $question->id) }}"
                                                        method="POST" onsubmit="return confirm('Are you sure?');">
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
                                    <div class="modal fade" id="editModal{{ $question->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('question.update', $question->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Question</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <label>Question</label>
                                                        <input class="form-control" name="question" type="text"
                                                            value="{{ $question->question }}"><br>

                                                        <label>Image</label>
                                                        <input class="form-control" name="image" type="file"><br>

                                                        <label>Point</label>
                                                        <input class="form-control" name="point" type="number"
                                                            value="{{ $question->point }}"><br>

                                                        <label>Topic</label>
                                                        <select class="form-control" name="topic_id">
                                                            @foreach ($topics as $topic)
                                                                <option value="{{ $topic->id }}"
                                                                    {{ $question->topic_id == $topic->id ? 'selected' : '' }}>
                                                                    {{ $topic->name }}
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

    <!-- Create Question Modal -->
    <div class="modal fade" id="createQuestionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('question.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Question</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label>Question</label>
                        <input class="form-control" name="question" type="text"><br>


                        <label>Point</label>
                        <input class="form-control" name="point" type="number" min="0"><br>

                        <label>Image </label>
                        <input class="form-control" name="image" type="file"><br>

                        <label>Topic</label>
                        <select class="form-control" name="topic_id">
                            @foreach ($topics as $topic)
                                <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                            @endforeach
                        </select><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Question</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
