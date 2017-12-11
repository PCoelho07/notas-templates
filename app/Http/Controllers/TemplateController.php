<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Template;
use App\Client;

use PDF;

use App\Traits\CustomBladeCompiler;

class TemplateController extends Controller
{

    use CustomBladeCompiler;
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
        // TO DO
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

    public function getContentTemplate(Request $request)
    {
        $idClient = $request->input('idClient');
        $idTemplate = $request->input('idTemplate');

        $client = Client::find($idClient);
        $template = Template::find($idTemplate);

        if (!$template || !$client) {
            return response()->json([
                'result' => 'error'
            ], 402);            
        }

        $matches = [];
        
        // Capturo os tokens
        $regex = preg_match('/{{ \$([aA-z]*) }}/', $template->text_template, $matches);

        // // Ver quais tokens
        // // carregar as variaveis de acordo com os tokens


        // var_dump($matches);

        $textCompiled = CustomBladeCompiler::render($template->text_template, ['nomeusuario' => $client->name]);

        return response()->json([
                'result' => $regex
        ]);



    }
}
