@extends('layout.layout')

@section('contant')
    <div class="pt-2 pb-4 d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h3 class="mb-3 fw-bold">Dashboard</h3>
            <h6 class="mb-2 op-7">{{ Auth::user()->name }}</h6>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="text-center icon-big icon-primary bubble-shadow-small">
                                <i class="fas fa-users"></i>
                                <h6>title</h6>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">model name</p>
                                <h4 class="card-title">titel</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}


    <div class="row">
        <div class="col-md-12">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">All users info</div>
                        {{-- <div class="card-title">create butoon will be here </div> --}}
                    </div>
                </div>
                <div class="p-0 card-body">
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table mb-0 align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">User_id</th>
                                    <th scope="col" class="text-center">Name </th>
                                    <th scope="col" class="text-center">Email</th>
                                    <th scope="col" class="text-center">PONT</th>
                                    <th scope="col" class="text-center">levil</th>
                                    <th scope="col" class="text-center">Actiom</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($allUsers as $allUser)
                                    <tr>
                                        <td class="text-center">{{ $allUser->id }}</td>
                                        <td class="text-center">{{ $allUser->name }}</td>
                                        <td class="text-center">{{ $allUser->email }}</td>
                                        <td class="text-center">{{ $allUser->points }}</td>
                                        <td class="text-center">
                                            {{ $allUser->level_name }}
                                        </td>


                                        <td class="text-center">
                                            <div class="m-0 row w-100 ">

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
