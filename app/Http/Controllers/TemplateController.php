<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Template;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('templates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('templates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'client_roles_id'   => $request->input('roles_id'),
            'text_template'     => $request->input('txt_template'),
            'nome'              => $request->input('nome')
        ];

        $templates = Template::create($data);

        return response()->json(['result' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('templates.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');

        $template = Template::find($id);

        if($template) {
            $template->delete();
        }

        return response()->json([
            'result' => Template::with(['roles'])->get()
        ]);
    }


    public function getAll()
    {
        $templates = Template::with(['roles'])->get();        

        return response()->json([
            'result' => $templates
        ]);
    }
}
