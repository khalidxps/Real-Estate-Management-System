<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PermissionExport;
use App\Imports\PermissionImport;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    public function AllPermission()
    {
        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission', compact('permissions'));
    }

    public function AddPermission()
    {
        return view('backend.pages.permission.add_permission');
    }

    public function StorePermission(Request $request)
    {
        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function EditPermission($id)
    {
        $permissions = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission', compact('permissions'));
    }

    public function UpdatePermission(Request $request)
    {
        $pid = $request->id;

        Permission::findOrFail($pid)->update([

            'name' => $request->name,
            'group_name' => $request->group_name,

        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    }

    public function DeletePermission($id)
    {
        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ImportPermission()
    {
        return view('backend.pages.permission.import_permission');
    }

    public function Export()
    {
        return Excel::download(new PermissionExport, 'permission.xlsx');
    }

    public function Import(Request $request)
    {
        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification = array(
            'message' => 'Permission File Imported Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AllRole()
    {
        $roles = Role::all();
        return view('backend.pages.role.all_role', compact('roles'));
    }

    public function AddRole()
    {
        return view('backend.pages.role.add_role');
    }

    public function StoreRole(Request $request)
    {
        $roles = Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.role')->with($notification);
    }

    public function EditRole($id)
    {
        $roles = Role::findOrFail($id);
        return view('backend.pages.role.edit_role', compact('roles'));
    }

    public function UpdateRole(Request $request)
    {
        $rid = $request->id;

        Role::findOrFail($rid)->update([

            'name' => $request->name,

        ]);

        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.role')->with($notification);
    }

    public function DeleteRole($id)
    {
        Role::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    ///////////////// Add Role & Permission Method
    public function AddRolesPermission()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.add_roles_permission', compact('roles', 'permissions', 'permission_groups'));
    }
    public function RolePermissionStore(Request $request)
    {
        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }
        $notification = array(
            'message' => 'Role Permission Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }

    public function AllRolesPermission()
    {
        $roles = Role::all();
        return view('backend.pages.rolesetup.all_roles_permission', compact('roles',));
    }

    public function AdminEditRoles($id)
    {
        $roles = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.edit_roles_permission', compact('roles', 'permissions', 'permission_groups'));
    }

    public function AdminRolesUpdate(Request $request, $id)
    {

        $roles = Role::findOrFail($id);
        $permissions = $request->permission;
        if(!empty($permissions)){
            $roles->syncPermissions($permissions); 
        }

        $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }

    public function AdminDeleteRole($id)
    {
        $roles = Role::findOrFail($id)->delete();
        if(!is_null($roles))
        {
            $roles->delete();
        }

        $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    
    // public function AdminRolesUpdate(Request $request, $id)
    // {
    //     try {
    //         $roles = Role::findOrFail($id);
    //         $permissions = $request->permission;
    
    //         // Debugging: Log the permissions received from the request
    //         Log::info('Permissions received:', $permissions);
    
    //         if (!empty($permissions)) {
    //             // Debugging: Log the permissions being synchronized
    //             Log::info('Permissions to sync:', $permissions);
    //             $roles->syncPermissions($permissions);
    //         }
    
    //         $notification = [
    //             'message' => 'Role Permission Updated Successfully',
    //             'alert-type' => 'success'
    //         ];
    
    //         return redirect()->route('all.roles.permission')->with($notification);
    //     } catch (\Throwable $e) {
    //         Log::error('Error updating role permissions: ' . $e->getMessage());
    //         $notification = [
    //             'message' => 'Error updating role permissions',
    //             'alert-type' => 'error'
    //         ];
    //         return back()->with($notification);
    //     }
    // }
}
