<?php

namespace App\Http\Controllers\Administration\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\Admin\AdminFormRequest;
use App\Http\Requests\Application\Admin\AdminPermissionFormRequest;
use App\Http\Requests\Application\Admin\AdminUpdateFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::with('roles')->get();

        return view('theme.pages.Admin.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::all()->reject(function ($role, $key) {
            return $role->name === 'Developper';
        });

        return view('theme.pages.Admin.__create.index', compact('roles'));
    }

    public function store(AdminFormRequest $request)
    {
        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->telephone = $request->telephone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        //$user->super_admin = $request->super_admin;
        $user->save();

        $user->assignRole($request->role);

        return redirect()->back()->with('success', "L'ajoute a éte effectuer avec success");
    }

    public function edit(User $admin)
    {
        abort_if($admin->email === 'abdelgha4or@gmail.com' || $admin->hasRole('Developper'), 403);

        $permissions = Permission::all();

        $roles = Role::all()->reject(function ($role, $key) {
            return $role->name === 'Developper';
        });

        return view('theme.pages.Admin.__profile.index', compact('admin', 'permissions', 'roles'));
    }

    public function update(AdminUpdateFormRequest $request, User $admin)
    {
        abort_if($admin->email === 'abdelgha4or@gmail.com' || $admin->hasRole('Developper'), 403);

        $admin->nom = $request->nom;
        $admin->prenom = $request->prenom;
        $admin->telephone = $request->telephone;
        $admin->email = $request->email;

        $admin->active = $request->boolean('active');

        $request->whenFilled('password', function ($input) use ($admin) {
            $admin->password = Hash::make($input);
        });

        $admin->save();

        $admin->syncRoles($request->role);

        return redirect()->back()->with('success', 'Update a éte effectuer avec success');
    }

    public function syncPermission(AdminPermissionFormRequest $request, User $admin)
    {
        abort_if($admin->email === 'abdelgha4or@gmail.com' || $admin->hasRole('Developper'), 403);

        $admin->syncPermissions($request->permissions);

        return redirect()->back()->with('permissions', 'Les permissions sont synchronisée avec succès');
    }

    public function anon()
    {
    }

    public function delete(Request $request)
    {
        $request->validate(['adminId' => 'required|uuid']);

        $admin = User::whereUuid($request->adminId)->firstOrFail();

        abort_if($admin->email === 'abdelgha4or@gmail.com' || $admin->hasRole('Developper'), 403);

        if ($admin) {
            // dd('Ouuuui roole admin');
            //$admin->roles()->detach();
            // $admin->permissions()->detach();

            // $admin->forgetCachedPermissions();

            //  $admin->delete();

            return redirect()->back()->with('success', "L' Admin  a éte supprimer  avec success");
        }

        return redirect()->back()->with('success', 'un problem a été détécter ... ');
    }
}
