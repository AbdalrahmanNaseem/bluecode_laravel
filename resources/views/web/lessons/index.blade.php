@extends('layout.layout')

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
                        <div class="card-title">All Courses lessons</div>
                        <button data-bs-toggle="modal" data-bs-target="#createModal"
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
                                    <th class="text-center">Name</th>

                                    <th class="text-center">Image</th>
                                    <th class="text-center">courses </th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lessons as $lesson)
                                    <tr>
                                        <td class="text-center">{{ $lesson->id }}</td>
                                        <td class="text-center">{{ $lesson->name }}</td>
                                        <td class="text-center">
                                            @if ($lesson->image)
                                                <img src="{{ asset($lesson->image) }}" alt="course image" width="50">
                                            @endif
                                        </td>
                                        <th class="text-center"> {{ $lesson->course->name }} </th>

                                        <td class="text-center">
                                            <div class="row justify-content-center">
                                                <div class="col-auto">
                                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $lesson->id }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </div>
                                                <div class="col-auto">
                                                    <form action="{{ route('Course.destroy', $lesson->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this course?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" type="submit">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $lesson->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit lesones</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <form action="{{ route('lesson.update', $lesson->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="modal-body">
                                                                <label>Name</label>
                                                                <input class="form-control" name="name" type="text"
                                                                    value="{{ $lesson->name }}"><br>
                                                                <label>Image</label>
                                                                <input class="form-control" name="image"
                                                                    type="file"><br>
                                                                <label>Course</label>
                                                                <select class="form-control" name="course_id">
                                                                    @foreach ($courses as $course)
                                                                        <option value="{{ $course->id }}"
                                                                            {{ $lesson->course_id == $course->id ? 'selected' : '' }}>
                                                                            {{ $course->name }}</option>
                                                                    @endforeach
                                                                </select>
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
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('lesson.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add lesson</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label>Name</label>
                        <input class="form-control" name="name" type="text"><br>
                        <label>Image</label>
                        <input class="form-control" name="image" type="file"><br>
                        <label>Course</label>
                        <select class="form-control" name="course_id">
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
