<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cliente;

class Controladorcliente extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {
        return view('clientes');
    }
    
    public function index()
    {
       $cli = cliente::all();
        return json_encode($cli);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cli = new cliente();
        $cli->razao = $request->input('razao');
        $cli->cnpj = $request->input('cnpj');
        $cli->cpf = $request->input('cpf');
        $cli->email = $request->input('email');
        $cli->telefone1 = $request->input('telefone1');
        $cli->telefone2 = $request->input('telefone2');
        $cli->cep = $request->input('cep');
        $cli->endereco = $request->input('endereço');
        $cli->numero = $request->input('numero');
        $cli->save();
        return json_encode($cli);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cli = cliente::find($id);
        if (isset($cli)) {
            return json_encode($cli);            
        }
        return response('cliente não encontrado', 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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


        $cli = cliente::find($id);
        if (isset($cli)) {
        $cli->razao = $request->input('razao');
        $cli->cnpj = $request->input('cnpj');
        $cli->cpf = $request->input('cpf');
        $cli->email = $request->input('email');
        $cli->telefone1 = $request->input('telefone1');
        $cli->telefone2 = $request->input('telefone2');
        $cli->cep = $request->input('cep');
        $cli->endereco = $request->input('endereço');
        $cli->numero = $request->input('numero');
        $cli->save();
        return json_encode($cli);
         }
        return response('Cliente não encontrado', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $cli = cliente::find($id);
        if (isset($cli)) {
            $cli->delete();
            return response('OK', 200);
        }
        return response('Produto não encontrado', 404);
    }
}
