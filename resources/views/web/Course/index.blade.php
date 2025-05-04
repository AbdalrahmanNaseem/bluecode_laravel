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
                        <div class="card-title">All Courses</div>
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
                                    <th class="text-center">#</th>
                                    <th class="text-center">modeul name</th>
                                    <th class="text-center">moduel description</th>
                                    <th class="text-center">moduel image</th>
                                    <th class="text-center">moudel type</th>
                                    <th class="text-center">الاعمدة التي تم انشائهم الخاصة بهاد التيبيل </th>
                                    <th class="text-center">الاعمدة التي تم انشائهم الخاصة بهاد التيبيل </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td class="text-center">{{ $course->id }}</td>
                                        <td class="text-center">{{ $course->name }}</td>
                                        <td class="text-center">{{ substr($course->description, 0, 50) }}</td>
                                        <td class="text-center">
                                            @if ($course->image)
                                                <img src="{{ asset($course->image) }}" alt="course image" width="50">
                                            @endif
                                        </td>
                                        <td class="text-center"> {{ $course->type }} </td>
                                        <td class="text-center">
                                            <ul class="list-group">
                                                @foreach ($course->lessons as $courselesson)
                                                    <li>
                                                        <div class="pb-2 row">
                                                            <div class="col-3"> {{ $courselesson->name }}
                                                            </div>
                                                            <div class="col-3"><img src="{{ asset($courselesson->image) }}"
                                                                    style="width: 100%; height: 100%;" alt=""></div>
                                                            <div class="col-3">
                                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                                    data-bs-target="#detailsModal{{ $courselesson->id }}">
                                                                    Details
                                                                </button>
                                                            </div>

                                                        </div>


                                                    </li>
                                                    <!-- Details Modal -->
                                                    <div class="modal fade" id="detailsModal{{ $courselesson->id }}"
                                                        tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Lesson Details</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><strong>Name:</strong> {{ $courselesson->name }}</p>
                                                                    <p><strong>Course:</strong>
                                                                        {{ $courselesson->course->name ?? 'N/A' }}</p>
                                                                    <p><strong>Added By:</strong>
                                                                        {{ $courselesson->user->name ?? 'N/A' }}</p>
                                                                    <p><strong>Image:</strong></p>
                                                                    <img src="{{ asset($courselesson->image) }}"
                                                                        class="rounded img-fluid" alt="Lesson Image">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </ul>
                                        </td>

                                        <td class="">
                                            <div class="row ">
                                                <div class="col-md-4 ">
                                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $course->id }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </div>


                                                <div class="col-md-4 ">
                                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#CourselessonModal{{ $course->id }}">
                                                        add lessons

                                                    </button>
                                                </div>



                                                <div class="col-md-4 ">
                                                    <form action="{{ route('Course.destroy', $course->id) }}"
                                                        method="POST"
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
                                            <div class="modal fade" id="editModal{{ $course->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('Course.update', $course->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Course</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label>Name</label>
                                                                <input class="form-control" name="name" type="text"
                                                                    value="{{ $course->name }}"><br>
                                                                <label>Description</label>
                                                                <textarea class="form-control" name="description">{{ $course->description }}</textarea><br>
                                                                <label>Image</label>
                                                                <input class="form-control" name="image"
                                                                    type="file"><br>
                                                                <label for="type">Type</label>
                                                                <select class="form-control" value="{{ $course->type }}"
                                                                    name="type" id="type">
                                                                    <option value="Core Modules">Core Modules</option>
                                                                    <option value="Learn Module">Learn Module</option>
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




                                            <!-- Courselesson Modal -->
                                            <div class="modal fade" id="CourselessonModal{{ $course->id }}"
                                                tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('Courselesson.store', $course->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Create Course lessons</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label>Name</label>
                                                                <input class="form-control" name="name"
                                                                    type="text"><br>
                                                                <label>Image</label>
                                                                <input class="form-control" name="image"
                                                                    type="file"><br>

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Create</button>
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
                <form action="{{ route('Course.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label>Name</label>
                        <input class="form-control" name="name" type="text"><br>
                        <label>Description</label>
                        <textarea class="form-control" name="description"></textarea><br>
                        <label>Image</label>
                        <input class="form-control" name="image" type="file">
                        <label for="type">Type</label>
                        <select class="form-control" name="type" id="type">
                            <option value="Core Modules">Core modules</option>
                            <option value="Learn Module">Learn Module</option>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
