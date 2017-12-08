<?php

namespace App\Http\Controllers\Client;

use App\Client\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('id')->get();

        return view('client-roles.index', compact('roles'));
    }

    public function create()
    {
        $role = new Role;

        return view('client-roles.create', compact('role'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|max:50',
            'description' => 'required|max:50',
        ]);

        Role::create($request->all());

        \Session::flash('message', 'Papel de cliente criado com sucesso!');

        return redirect('client-roles');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('client-roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'type' => 'required|max:50',
            'description' => 'required|max:50',
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->all());

        \Session::flash('message', 'Papel de cliente editado com sucesso!');

        return redirect('client-roles');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        \Session::flash('message', 'Papel de cliente excluído com sucesso!');

        return redirect('client-roles');
    }

    public function getAll()
    {
        $role = Role::all();

        return response()->json([
            'result' => $role
        ]);
    }
}
