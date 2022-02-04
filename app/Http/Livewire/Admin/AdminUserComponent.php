<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\RefreshesPermissionCache;

class AdminUserComponent extends Component
{
    use WithPagination;
    public $searchTerm;
    public $role_id;
    public $permission_id;

    public function deleteUser($id){

        $user = User::find($id);
        $user->delete();
        session()->flash('message','El user se ha eliminado con exito');

    }

    public function updateUserRole($user_id)
    {
        $user = User::where(['id' => $user_id])->first();
        $user->assignRole($this->role_id);

        session()->flash('message','El rol del usuario se ha sido actualizado con exito');


    }

    public function updateUserPermission($user_id)
    {
        //$user = User::where(['id' => $user_id])->first();
        //$user->assignRole($this->role_id);
        $model_type = "App\\\Models\\\User";
        $query_insert_permissions_to_user =  "INSERT INTO model_has_permissions (permission_id, model_type, model_id)
        VALUES (".$this->permission_id.",'".$model_type."',".$user_id.")";
        $insert_permissions = DB::select($query_insert_permissions_to_user);

        session()->flash('message','El permiso del usuario se ha asociado con exito');


    }

    public function changePermission(){

            $this->permission_id = 0;

    }

    public function mount(){

        $this->role_id = 0;

    }

    public function deleteUserRole($role_id,$user_id){

        //$user = User::where(['id' => $user_id])->first();
        //$user->removeRole($role_id);

        $query_delete_roles_of_user =  "DELETE FROM model_has_roles 
        where role_id = ".$role_id." and model_id = ".$user_id."";
        $delete_roles = DB::select($query_delete_roles_of_user);

        session()->flash('message','El rol se ha eliminado con exito');

    }

    public function deleteUserPermission($permission_id,$user_id){

        //$user = User::where(['id' => $user_id])->first();

        $query_delete_permissions_of_user =  "DELETE FROM model_has_permissions 
        where permission_id = ".$permission_id." and model_id = ".$user_id."";
        $delete_permissions = DB::select($query_delete_permissions_of_user);

        //$user->removePermission($permission_id);
        session()->flash('message','El permiso se ha eliminado con exito');

    }

    public function render()
    {
        $search = '%'.$this->searchTerm.'%';
        $users = User::where('name','LIKE',$search)->paginate(4);
        $roles = Role::all();
        
        $query_permissions_by_role =  "SELECT a.id, a.name
        FROM permissions a, role_has_permissions b 
        where a.id = b.permission_id and b.role_id = ".$this->role_id."";
        $permissions = DB::select($query_permissions_by_role);
        

        //$permissions = Permission::where('id',$this->role_id)->get();
        
        return view('livewire.admin.admin-user-component',['users' => $users,'roles' => $roles,'permissions' => $permissions]);
    }
}
