@can('roles.view')
    {{-- <a href="{{ route('roles.show', $id) }}" class="btn btn-sm btn-clean btn-icon mr-2" title="View role">
        <span class="svg-icon svg-icon-md">
            <i class="fa fa-eye"></i>
        </span>
    </a> --}}
    <a href="{{ route('roles.show', $id) }}" class="btn btn-sm btn-primary hover-elevate-up py-2 px-4">
        <span class="svg-icon svg-icon-md">
            <i class="fa fa-pen"></i>
        </span>
        Show
    </a>
@endcan

@can('roles.edit')
    {{-- <a href="{{ route('roles.edit', $id) }}" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit role">
        <span class="svg-icon svg-icon-md">
            <i class="fa fa-pen text-warning"></i>
        </span>
    </a> --}}
    <a href="{{ route('roles.edit', $id) }}" class="btn btn-sm btn-warning hover-elevate-up py-2 px-4">
        <span class="svg-icon svg-icon-md">
            <i class="fa fa-pen "></i>
        </span>
        Edit
    </a>
@endcan

@can('roles.delete')
    {{-- <a class="btn btn-sm btn-clean btn-icon mr-2" title="Delete role" data-bs-toggle="modal"
        data-bs-target="#delete{{ $id }}">
        <i class="fa fa-trash text-danger"></i>
    </a> --}}
    <a data-bs-toggle="modal" data-bs-target="#delete{{ $id }}" class="btn btn-sm btn-danger hover-elevate-up py-2 px-4">
        <span class="svg-icon svg-icon-md">
            <i class="fa fa-trash"></i>
        </span>
        Delete
    </a>
@endcan


<div id="delete{{ $id }}" class="delete-modal modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Delete</h5>
                <!--begin::Close-->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <!--end::Close-->
            </div>
            <div class="modal-body text-center">
                <h4 class="modal-heading">
                    Are You Sure ?
                </h4>
                <p class="text-muted">Do you really want to delete this role <b>{{ $name }}</b> ? <b>
                        By Clicking YES,
                    </b>This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <form method="post" action="{{ route('roles.destroy', $id) }}" class="float-right">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">
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
