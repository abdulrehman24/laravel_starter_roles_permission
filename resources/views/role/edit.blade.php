@extends('layouts.admin.master')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between flex-column flex-md-row">
                        <h5 class="card-title"> Edit role</h5>

                        <div class="card-toolbar">
                            <!--begin::Button-->
                            <a href="{{ route('roles.index') }}" class="btn btn-primary font-weight-bolder">
                                <span class="svg-icon svg-icon-md">
                                    <i class="fa fa-arrow-left me-2"></i>
                                </span>Back
                            </a>
                            <!--end::Button-->
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('roles.update', $role->uuid) }}" method="POST" class="needs-validation"
                            novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" class="text-dark"> Role name <span
                                        class="text-danger">*</span></label>
                                <input name="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="Enter role name" value="{{ $role->name }}" required autofocus>

                                <input type="hidden" name="guard" value="web">

                                @error('name')
                                    <span class="text-red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="fv-row">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>
                                <!--end::Label-->

                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 permissionTable">
                                        <!--begin::Table body-->
                                        <tbody class="text-gray-600 fw-semibold">
                                            <!--begin::Table row-->
                                            <tr>
                                                <td class="text-gray-800">
                                                    Section
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        aria-label="Allows a full access to the system"
                                                        data-bs-original-title="Allows a full access to the system">
                                                        <i class="fa fa-info-circle "></i></span>
                                                </td>
                                                <td>
                                                    <!--begin::Checkbox-->
                                                    <label
                                                        class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                        <input class="form-check-input grand_selectall" type="checkbox"
                                                            id="kt_roles_select_all">
                                                        <span class="form-check-label" for="kt_roles_select_all">
                                                            Select all
                                                        </span>
                                                    </label>
                                                    <!--end::Checkbox-->
                                                </td>
                                                <td>
                                                    Available permissions
                                                </td>
                                            </tr>
                                            <!--end::Table row-->
                                            @foreach ($custom_permission as $key => $group)
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Label-->
                                                    <td class="text-gray-800"><b>{{ ucfirst($key) }}</b></td>
                                                    <!--end::Label-->
                                                    <td>
                                                        <!--begin::Checkbox-->
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-9">

                                                            <input class="form-check-input selectall" type="checkbox"
                                                                id="kt_roles_select_all">
                                                            <span class="form-check-label" for="kt_roles_select_all">
                                                                Select all
                                                            </span>
                                                        </label>
                                                        <!--end::Checkbox-->
                                                    </td>

                                                    <!--begin::Input group-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="">
                                                            <!--begin::Checkbox-->
                                                            <div class="d-flex flex-column">
                                                                @forelse($group as $permission)
                                                                    <div class="form-check me-3 me-lg-5">
                                                                        <input class="form-check-input permissioncheckbox"
                                                                            type="checkbox" name="permissions[]"
                                                                            id="userManagementRead_{{ $permission->id }}"
                                                                            value="{{ $permission->name }}"
                                                                            {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>

                                                                        <label class="form-check-label"
                                                                            for="userManagementRead_{{ $permission->id }}">
                                                                            {{ $permission->name }} </label>
                                                                    </div>


                                                                @empty
                                                                    No permission in this group.
                                                                @endforelse
                                                            </div>

                                                            <!--end::Checkbox-->

                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Input group-->
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <div class="form-group text-end mt-4">
                                <button type="reset" class="btn btn-danger mr-1" onclick="resetCheckboxes()"><i class="fa fa-ban me-2"></i>
                                    Reset</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle me-2"></i>
                                    Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('admin-assets/js/checkbox.js') }}"></script>
@endpush