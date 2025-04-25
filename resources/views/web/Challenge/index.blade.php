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
                        <div class="card-title">All challenges</div>
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
                                    <th class="text-center">id</th>
                                    <th class="text-center">name</th>
                                    <th class="text-center">description</th>
                                    <th class="text-center">image</th>
                                    <th class="text-center">vm_download_link</th>
                                    <th class="text-center">difficulty </th>
                                    <th class="text-center">points</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($challenges as $challenge)
                                    <tr>
                                        <td class="text-center">{{ $challenge->id }}</td>
                                        <td class="text-center">{{ $challenge->name }}</td>
                                        <td class="text-center">{{ $challenge->description }}</td>
                                        <td class="text-center">
                                            @if ($challenge->image)
                                                <img src="{{ asset($challenge->image) }}" alt="challenge image"
                                                    width="50">
                                            @endif
                                        </td>
                                        <td class="text-center"> {{ $challenge->vm_download_link }} </td>
                                        <td class="text-center"> {{ $challenge->difficulty }} </td>
                                        <td class="text-center"> {{ $challenge->points }} </td>


                                        <td class="">
                                            <div class="row ">
                                                <div class="col-md-4 ">
                                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $challenge->id }}">
                                                        <i class="bi bi-info-circle"></i> </button>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <a class="btn btn-sm btn-warning"
                                                        href="{{ route('challenge.reports') }}" {{ $challenge->id }}>

                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                </div>


                                                <div class="col-md-4 ">
                                                    <form action="{{ route('Course.destroy', $challenge->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this challenges?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" type="submit">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $challenge->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('challenges.update', $challenge->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Challenge</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label>Name</label>
                                                                <input class="form-control" name="name" type="text"
                                                                    value="{{ $challenge->name }}"><br>

                                                                <label>vm_download_link</label>
                                                                <input class="form-control" name="vm_download_link"
                                                                    type="text"
                                                                    value="{{ $challenge->vm_download_link }}"><br>

                                                                <label>Points</label>
                                                                <input class="form-control" name="points" type="number"
                                                                    value="{{ $challenge->points }}"><br>

                                                                <label>Description</label>
                                                                <textarea class="form-control" name="description">{{ $challenge->description }}</textarea><br>

                                                                <label>Image</label>
                                                                <input class="form-control" name="image"
                                                                    type="file"><br>
                                                                @if ($challenge->image)
                                                                    <img src="{{ asset($challenge->image) }}"
                                                                        alt="current image" width="80">
                                                                @endif
                                                                <br>

                                                                <div class="mb-3">
                                                                    <label for="difficulty"
                                                                        class="form-label">Difficulty</label>
                                                                    <select class="form-select" name="difficulty" required>
                                                                        <option value="easy"
                                                                            {{ $challenge->difficulty == 'easy' ? 'selected' : '' }}>
                                                                            Easy</option>
                                                                        <option value="medium"
                                                                            {{ $challenge->difficulty == 'medium' ? 'selected' : '' }}>
                                                                            Medium</option>
                                                                        <option value="hard"
                                                                            {{ $challenge->difficulty == 'hard' ? 'selected' : '' }}>
                                                                            Hard</option>
                                                                    </select>
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
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('challenge.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label>Name</label>
                        <input class="form-control" name="name" type="text"><br>
                        <label>vm_download_link</label>
                        <input class="form-control" name="vm_download_link" type="text"><br>
                        <label>points</label>
                        <input class="form-control" name="points" type="number"><br>
                        <label>Description</label>
                        <textarea class="form-control" name="description"></textarea><br>
                        <label>Image</label>
                        <input class="form-control" name="image" type="file">
                        <div class="mb-3">
                            <label for="difficulty" class="form-label">Difficulty</label>
                            <select class="form-select" name="difficulty" id="difficulty" required>
                                <option value="" disabled selected>Select difficulty</option>
                                <option value="easy">Easy</option>
                                <option value="medium">Medium</option>
                                <option value="hard">Hard</option>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
