<?php

namespace App\Http\Controllers;

use App\Models\Movimento;
use App\Models\Conta;

use Illuminate\Http\Request;

class MovimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'movimentos' => Movimento::orderBy('data', 'DESC')->orderBy('id', 'DESC')->get(),
        ];

        return view('movimentos.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'contas' => Conta::orderBy('nome')->get(),
        ];

        return view('movimentos.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'conta_id'      => 'required|integer',
            'data'          => 'required|date',
            'valor'         => 'required|numeric',
            'descricao'     => 'string|max:191',
        ]);       

        $r = Movimento::create($request->all());

        if($r)
            return response()->json(['result' => 'success', 'message' => 'Movimento ' . $r->id . ' criado.']);
        else
            return response()->json(['result' => 'error', 'message' => 'Erro ao criar movimento.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movimento  $movimento
     * @return \Illuminate\Http\Response
     */
    public function show(Movimento $movimento)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movimento  $movimento
     * @return \Illuminate\Http\Response
     */
    public function edit(Movimento $movimento)
    {
        $data = [
            'movimento' => $movimento,
            'contas'    => Conta::orderBy('nome')->get(),
        ];

        return view('movimentos.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movimento  $movimento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movimento $movimento)
    {
        $this->validate($request, [
            'conta_id'      => 'required|integer',
            'data'          => 'required|date',
            'valor'         => 'required|numeric',
            'descricao'     => 'string|max:191',
        ]);

        $movimento->update($request->all());
        
        if($r)
            return response()->json(['result' => 'success', 'message' => 'Movimento ' . $r->id . ' editado.']);
        else
            return response()->json(['result' => 'error', 'message' => 'Erro ao editar movimento.']);
    }

    /**
     * Show the form for deleting a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Movimento $movimento)
    {
        $data = [
            'movimento' => $movimento,
        ];
        
        return view('movimentos.delete', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movimento  $movimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movimento $movimento)
    {
        if($movimento->delete())
            return response()->json(['result' => 'success', 'message' => 'Movimento ' . $movimento->id . ' eliminado.']);
        else
            return response()->json(['result' => 'error', 'message' => 'Erro ao eliminar movimento ' . $movimento->id . '.']);
    }
}
