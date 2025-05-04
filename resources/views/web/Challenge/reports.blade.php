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
                                    <th class="text-center">#</th>
                                    <th class="text-center">Solved by</th>
                                    <th class="text-center">challenge_id</th>
                                    <th class="text-center">report_file_path</th>
                                    <th class="text-center">status</th>
                                    <th class="text-center">admin_feedback</th>
                                    <th class="text-center">submitted_at</th>
                                    <th class="text-center">Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($challenges_submitted as $submitted)
                                    <tr>
                                        <td class="text-center">{{ $submitted->id }}</td>

                                        <td class="text-center">{{ $submitted->user->name }}</td>
                                        <td class="text-center">{{ $submitted->challenge->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ asset('storage/' . $submitted->report_file_path) }}"
                                                target="_blank">View Report</a>
                                        </td>
                                        <td class="text-center">{{ $submitted->status }}</td>
                                        <td class="text-center">
                                            <a href="{{ asset('storage/' . $submitted->admin_feedback) }}" target="_blank">
                                                View Report
                                            </a>

                                        </td>
                                        <td class="text-center">{{ $submitted->submitted_at }}</td>



                                        <td class="">
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $submitted->id }}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                        </td>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $submitted->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $submitted->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST"
                                                        action="{{ route('challenge_reports.update', $submitted->id) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editModalLabel{{ $submitted->id }}">Edit Submission
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="admin_feedback" class="form-label">Admin
                                                                    Feedback</label>
                                                                <input type="file" name="admin_feedback"
                                                                    class="form-control" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select class="form-select" name="status" required>
                                                                    <option value="accepted"
                                                                        {{ $submitted->status == 'accepted' ? 'selected' : '' }}>
                                                                        Accepted</option>
                                                                    <option value="rejected"
                                                                        {{ $submitted->status == 'rejected' ? 'selected' : '' }}>
                                                                        Rejected</option>
                                                                    <option value="pending"
                                                                        {{ $submitted->status == 'pending' ? 'selected' : '' }}>
                                                                        Pending</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Save
                                                                changes</button>
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
@endsection
