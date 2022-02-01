<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

    public function updateUserPermission($user_id)
    {
        //$order = Order::find($order_id);
        //$order->status = $status;
        //$order->save();

        $user = User::where(['id' => $user_id])->first();
        $user->assignRole($this->role_id);

        session()->flash('message','El permiso del usuario se ha sido actualizado con exito');


    }

    public function changePermission(){

            $this->permission_id = 0;

    }

    public function mount(){

        $this->role_id = 0;

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
