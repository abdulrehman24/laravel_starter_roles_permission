<?php

namespace App\Http\Controllers\Role;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:roles.view', ['only' => ['index']]);
        // $this->middleware('permission:roles.add', ['only' => ['create', 'store']]);
        // $this->middleware('permission:roles.edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:roles.delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $currentUserRole = auth()->user()->getRoleNames()->first();
        $filteredRoles = collect();

        if ($currentUserRole === 'super admin') {
            $filteredRoles = Role::where('name', 'club')->select('uuid', 'name')->with('permissions')->withCount('users')->get();
        } elseif ($currentUserRole === 'club') {
            $filteredRoles = Role::whereIn('name', ['club admin', 'team', 'team admin', 'player'])->select('uuid', 'name')->with('permissions')->withCount('users')->get();
        } elseif ($currentUserRole === 'club admin') {
            $filteredRoles = Role::whereIn('name', ['team', 'team admin', 'player'])->select('uuid', 'name')->with('permissions')->withCount('users')->get();
        }

        $custom_permission = [];

        foreach ($filteredRoles as $role) {
            $custom_role = [];

            foreach ($role->permissions as $per) {
                $key = substr($per->name, 0, strpos($per->name, '.'));

                if (str_starts_with($per->name, $key)) {
                    $custom_role[$key][] = $per;
                }
            }
            $custom_role['users_count'] = $role->users_count;
            $custom_role['role_id'] = $role->uuid;

            $custom_permission[$role->name] = $custom_role;
        }

        return view('role.index', compact('custom_permission'));
    }

    public function create()
    {
        $role_permission = Permission::select('name')->groupBy('name')->get();

        $custom_permission = [];

        foreach ($role_permission as $per) {
            $key = substr($per->name, 0, strpos($per->name, '.'));

            if (str_starts_with($per->name, $key)) {
                $custom_permission[$key][] = $per;
            }
        }

        return view('role.create', compact('custom_permission'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
        ]);

        $role = Role::create(['name' => strtolower($request->name)]);

        if ($request->permissions) {
            foreach ($request->permissions as $key => $value) {
                $role->givePermissionTo($value);
            }
        }

        return redirect()->route('roles.index')->with('success', 'Created Successfully');
    }

    public function show($id)
    {
        $role = Role::with('permissions')->find($id);

        $role_permission = Permission::select('name', 'uuid')->get();

        $custom_permission = [];

        foreach ($role_permission as $per) {
            $key = substr($per->name, 0, strpos($per->name, '.'));

            if (str_starts_with($per->name, $key)) {
                $custom_permission[$key][] = $per;
            }
        }

        return view('role.view', compact('role_permission', 'role', 'custom_permission'));
    }

    public function edit($id)
    {
        $roles = Role::select('uuid')->where('name', 'super admin')->get()->pluck('uuid')->toArray();

        if (in_array($id, $roles)) {
            return redirect()->route('roles.index')->with('error', 'System role can not be edit.');
        }

        $role = Role::with('permissions')->find($id);

        $role_permission = Permission::select('name', 'uuid')->get();

        $custom_permission = [];

        foreach ($role_permission as $per) {
            $key = substr($per->name, 0, strpos($per->name, '.'));

            if (str_starts_with($per->name, $key)) {
                $custom_permission[$key][] = $per;
            }
        }

        return view('role.edit', compact('role_permission', 'role', 'custom_permission'));
    }

    public function update(Request $request, $id)
    {
        $roles = Role::select('uuid')->where('name', 'super admin')->pluck('uuid')->toArray();
        if (in_array($id, $roles)) {
            return redirect()->route('roles.index')->with('error', 'System role cannot be edit.');
        }

        $role = Role::where('uuid', $id)->first();

        $request->validate([
            'name' => 'required|unique:roles,name,' . $id . ',uuid',
        ]);

        $role->name = strtolower($request->name);
        $role->save();

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', ucwords($role->name) . ' Updated Successfully');
    }

    public function destroy($id)
    {
        $roles = Role::select('uuid')->where('name', 'super admin')->pluck('uuid')->toArray();
        if (in_array($id, $roles)) {
            return redirect()->route('roles.index')->with('error', 'System role cannot be edit.');
        }

        $role = Role::findOrFail($id);

        $users = User::role($role->name)->get();

        if ($users->isNotEmpty()) {
            return redirect()->route('roles.index')->with('error', 'Cannot delete this role user has attached to this role.');
        }

        $role->permissions()->detach();
        $role->delete();

        // foreach ($users as $user) {
        //     $user->roles()->detach();
        //     $user->addresss?->each->delete();
        //     $user->userVendor?->delete();
        // }

        return redirect()->route('roles.index')->with('delete', ucwords($role->name) . ' Deleted Successfully');
    }
}
