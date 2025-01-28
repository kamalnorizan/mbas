@extends('falcon.master')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.min.css">
@endsection

@section('content')
    <div class="card shadow-none border mb-2">
        <div class="bg-holder bg-card d-none d-md-block"
            style="background-image:url( {{ asset('falcon/assets/img/illustrations/reports-bg.png') }});">
        </div>
        <!--/.bg-holder-->

        <div class="card-header z-1">
            <div class="row flex-between-center gx-0">
                <div class="col-lg-auto d-flex align-items-center"><img class="img-fluid"
                        src="{{ asset('falcon/assets/img/illustrations/reports-greeting.png') }}" alt="" />
                    <div class="ms-x1">
                        <h4 class="mb-0 text-primary fw-bold">MBAS <span class="text-info fw-medium">Role Management</span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <img class="card-img-top" src="holder.js/100x180/" alt="">
        <div class="card-body">
            <h4 class="card-title">Roles List</h4>
            <table class="table table-hover display responsive" id="role-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Role Name</th>
                        <th>Description</th>
                        <th>User Count</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ strtoupper($role->name) }}</td>
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->users->count() }}</td>
                            <td>
                                <a href="{{ route('roles.edit', $role->uuid) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ route('roles.destroy', $role->uuid) }}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>

    <script>
        $('#role-table').DataTable();
    </script>
@endsection
