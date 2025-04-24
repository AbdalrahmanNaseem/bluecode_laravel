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
                        <div class="card-title">All Level Info</div>

                        <div>

                            <button data-bs-toggle="modal" data-bs-target="#createModal"
                                class="btn btn-success d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px; border-radius: 10 px;">
                                <i class="text-white bi bi-plus" style="font-size: 25px;"></i>
                            </button>

                        </div>
                    </div>
                </div>

                <div class="p-0 card-body">
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table mb-0 align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">id</th>
                                    <th scope="col" class="text-center">name </th>
                                    <th scope="col" class="text-center">start</th>
                                    <th scope="col" class="text-center">end</th>
                                    <th scope="col" class="text-center">Actiom</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($levels as $level)
                                    <tr>
                                        <td class="text-center">{{ $level->id }}</td>
                                        <td class="text-center">{{ $level->name }}</td>
                                        <td class="text-center">{{ $level->start }}</td>
                                        <td class="text-center">{{ $level->end }}</td>
                                        <td class="text-center">
                                            <div class="m-0 row w-100 justify-content-center">
                                                <div class="col-auto">
                                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#editModal{{ $level->id }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </div>
                                                <div class="col-auto">


                                                    <form action="{{ route('level.destroy', $level->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this level?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" type="submit">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal{{ $level->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel{{ $level->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('level.update', $level->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="editModalLabel{{ $level->id }}">Edit Level</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <label for="name">Name</label>
                                                                <input class="form-control" name="name" type="text"
                                                                    value="{{ $level->name }}"><br>

                                                                <label for="start">Start Point</label>
                                                                <input class="form-control" name="start" type="number"
                                                                    value="{{ $level->start }}"><br>

                                                                <label for="end">End Point</label>
                                                                <input class="form-control" name="end" type="number"
                                                                    value="{{ $level->end }}">
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






    <!-- create  Modal  -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('level.store') }}" method="post">
                        @csrf

                        <label for="name">
                            name </label>
                        <input name="name" type="text"><br>

                        <label for="start">
                            start pont </label>
                        <input name="start" type="number"><br>

                        <label for="end">
                            end pont </label>
                        <input name="end" type="number">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
