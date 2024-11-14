@extends('layouts.admin.master')

@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="card">
                <div class="card-header d-flex justify-content-between flex-column flex-md-row">
                    <h5 class="card-title"> View role - {{ ucwords($role->name) }}</h5>

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

                    <div class="fv-row">
                        <!--begin::Label-->
                        <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>
                        <!--end::Label-->

                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <!--begin::Table body-->
                                <tbody class="text-gray-600 fw-semibold">
                                    <!--begin::Table row-->
                                    <tr>
                                        <td class="text-gray-800">
                                            Section
                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                aria-label="Allows a full access to the system"
                                                data-bs-original-title="Allows a full access to the system">
                                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span
                                                        class="path1"></span><span class="path2"></span><span
                                                        class="path3"></span></i></span>
                                        </td>
                                        <td>
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                <input class="form-check-input grand_selectall" type="checkbox" value=""
                                                    id="kt_roles_select_all" disabled>
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
                                                        id="kt_roles_select_all" disabled>
                                                       
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
                                                    @forelse($group as $permission)
                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20 mb-2">
                                                            <input class="form-check-input permissioncheckbox"
                                                                type="checkbox"
                                                                {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}
                                                                disabled>
                                                            <span class="form-check-label">
                                                                {{ $permission->name }}
                                                            </span>
                                                        </label>
                                                    @empty
                                                        No permission in this group.
                                                    @endforelse

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
                </div>
            </div>
        </div>
    </div>
    <!--begin::Input group-->
    <!--end::Permissions-->
@endsection

@push('script')
    <script src="{{ asset('admin-assets/js/checkbox.js') }}"></script>
@endpush
