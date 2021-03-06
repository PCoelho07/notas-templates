<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Template;
use App\Client;

use PDF;

use App\Traits\CustomBladeCompiler;
use App\Token;

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
    public function edit(Request $request)
    {
        // TO DO
        $template = Template::find()

        return view('templates.edit', ['template' => $template]);
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
        $data = [];
        
        $regex = preg_match_all('/{{ \$([aA-z]*) }}/', $template->text_template, $matches);


        for ($i = 0; $i < count($matches[1]) ; $i++) {
            
            $token = Token::where('slug', $matches[1][$i])
                                ->first();

            if ($token) {
                $data[$token->slug] = $client->{$token->variable};
            }
        }

        $textCompiled = CustomBladeCompiler::render($template->text_template, $data);

        return response()->json([
                'result' => $textCompiled
        ]);



    }
}
