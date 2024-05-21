<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use mysqli;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:show-permission|create-permission|edit-permission|delete-permission', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-permission', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-permission', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-permission', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mysqli = new mysqli('localhost', 'root', '', 'multi_auth');
        // Check connection
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        $query = "SELECT permissions.id, permissions.name, roles.name FROM permissions
            JOIN role_has_permissions ON role_has_permissions.permission_id=permissions.id
            JOIN roles ON roles.id = role_has_permissions.role_id ORDER BY permissions.id";

        $permissions = $mysqli->query($query)->fetch_all(); //0=id, 1=permission.name, 2=role.name
        foreach ($permissions as $permission) {
            $key = $permission[0] . $permission[1];
            if (!isset($permissionGroup[$key])) {
                $permissionGroup[$key] = $permission;
                if (is_string($permissionGroup[$key][2])) {
                    $permissionGroup[$key][2] = [$permissionGroup[$key][2]];
                }
            } else {
                if (is_string($permission[2])) {
                    $permissionGroup[$key][2][] = $permission[2];
                }
            }
        }
        $permissionGroup = array_values($permissionGroup);
        return view('permissions.index', ['permissions' => $permissionGroup]); //0=permission.id, 1=permission.name, 2=role.name
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.create', ['roles' => Role::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        $permission = Permission::create(['name' => $request->name]);
        foreach ($request->roles as $role) {
            $role = Role::get(['*'])->where('id', '=', $role)->first();
            // dd($permission);
            // dd($role);

            $role->givePermissionTo($permission);
        }
        return redirect()->route('permissions.index')->withSuccess('New permission is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission): View
    {
        $permissionRoles = Role::join("role_has_permissions", "role_id", "=", "id")
            ->where("permission_id", $permission->id)
            ->select('name')
            ->get();
        return view('permissions.show', [
            'permission' => $permission,
            'permissionRoles' => $permissionRoles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission): View
    {
        $permissionRoles = Role::join("role_has_permissions", "role_id", "=", "id")
            ->where("permission_id", $permission->id)
            ->select('name')
            ->get();
        return view('permissions.edit', [
            'permission' => $permission,
            'permissionRoles' => $permissionRoles,
            'roles' => Role::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        // jika di update, kida drop dulu role lama utk permission ini
        $permissionRoles = Role::join("role_has_permissions", "role_id", "=", "id")
            ->where("permission_id", $permission->id)
            ->get();
        foreach($permissionRoles as $thisRole){
            $permission->removeRole($thisRole);
        }

        $input = $request->only('name');
        $permission->update($input);
        $roles = Role::whereIn('id', $request->roles)->get(['id'])->toArray();
        foreach ($roles as $role) {
            $permission->assignRole($role);
        }
        return redirect()->back()->withSuccess('Permission is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();
        return redirect()->route('permissions.index')->withSuccess('Permission is deleted successfully.');
    }
}
