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
                    <h4 class="mb-0 text-primary fw-bold">MBAS <span class="text-info fw-medium">Role Management - Edit Role {{$role->name}}</span>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Role</h4>
        <form action="{{ route('roles.update', $role->uuid) }}" method="POST">
            @csrf
            @method('PUT')
            @include('role._form')
            <hr>
            <h4 class="card-title">Permissions</h4>
            <div class="row">
                @foreach ($permissions as $permission)
                <div class="col-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $permission->name }}" name="permissions[]"
                            id="permission-{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked @endif>
                        <label class="form-check
                            label" for="permission-{{ $permission->id }}">{{ Str::ucfirst(str_replace('-',' ',$permission->name)) }}</label>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary mt-2 float-end">Update</button>
        </form>
    </div>
</div>
@endsection

@section('js')

@endsection
