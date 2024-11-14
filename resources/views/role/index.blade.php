@extends('layouts.admin.master')
@section('title', 'Roles & Permissions')
@push('css')
    <style>
        .card.permissions {
            box-shadow: 0 11px 8px 0 rgb(0 0 0 / 4%), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .btn .svg-icon {
            margin-right: 0rem;
        }
    </style>
    {{-- <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
@endpush

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Roles List</h4>

        <p class="mb-4">
            A role provided access to predefined menus and features so that depending on
            assigned role an administrator can have access to what user needs.
        </p>
        <!-- Role cards -->
        <div class="row g-4">
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                    <p class="mb-0">{{ session('error') }}</p>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
            @endif
            @if (session('delete'))
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
                    <p class="mb-0">{{ session('delete') }}</p>
                </div>
            @endif
            @foreach ($custom_permission as $key => $role)
                <!-- Additional card layout -->
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6 class="fw-normal mb-2">Total {{ $role['users_count'] ?? 0 }} users</h6>
                            </div>
                            <div class="d-flex justify-content-between align-items-end mt-1">
                                <div class="role-heading">
                                    <h4 class="mb-1">{{ ucwords($key) }}</h4>
                                    
                                    @can('roles.edit')
                                        <a href="{{ route('roles.edit', $role['role_id']) }}"><span>Edit Role</span></a>
                                    @endcan
                                </div>
                                <div>
                                    @can('roles.view')
                                        <a href="{{ route('roles.show', $role['role_id']) }}" class="text-warning"><i
                                                class="ti ti-eye ti-md"></i></a>
                                    @endcan
                                    @can('roles.delete')
                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $role['role_id'] }}" class="text-danger"><i
                                                class="ti ti-trash ti-md"></i></a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="delete{{ $role['role_id'] }}" class="delete-modal modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Delete</h5>
                                <!--begin::Close-->
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                <!--end::Close-->
                            </div>
                            <div class="modal-body text-center">
                                <h4 class="modal-heading">
                                    Are You Sure ?
                                </h4>
                                <p class="text-muted">Do you really want to delete this role <b>{{ $key }}</b> ?
                                    <b>By Clicking YES, </b>This process cannot be undone.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <form method="post" action="{{ route('roles.destroy', $role['role_id']) }}"
                                    class="float-right">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">
                                        No
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        Yes
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="row h-100">
                        <div class="col-sm-5">
                            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                <img src="{{ asset('admin-assets/img/illustrations/add-new-roles.png') }}"
                                    class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <a href="{{ route('roles.create') }}"
                                    class="btn btn-primary mb-2 text-nowrap add-new-role waves-effect waves-light">
                                    Add New Role
                                </a>
                                <p class="mb-0 mt-1">Add role, if it does not exist</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Role cards -->
        </div>
    </div>
    <!-- / Content -->
@endsection

@push('script')
@endpush
