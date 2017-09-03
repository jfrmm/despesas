<?php

namespace App\Http\Controllers;

use App\Models\Conta;

use Illuminate\Http\Request;

class ContaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'contas' => Conta::all(),
        ];

        return view('contas.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [

        ];

        return view('contas.create', $data);
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
            'nome' => 'required|',
            'iban' => 'required|size:25|unique:contas,iban',
        ]);

        Conta::create($request->all());

        return redirect('/contas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function show(Conta $conta)
    {
        $data = [
            'conta' => $conta,
        ];

        return view('contas.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function edit(Conta $conta)
    {
        $data = [
            'conta' => $conta,
        ];

        return view('contas.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conta $conta)
    {
        $this->validate($request, [
            'nome' => 'required|',
            'iban' => 'required|size:25|unique:contas,iban,' . $conta->id,
        ]);

        $r = $conta->update($request->all());

        if($r == 0) {
            $message = [
                'type' => 'warning',
                'text' => 'Falha na edição de ' . $conta->nome . '.',
            ];

        } else {
            $message = [                
                'type' => 'success',
                'text' => 'Sucesso na edição de ' . $conta->nome  . '.',
            ];

        }

        $data = [
            'conta' => $conta,
            'message' => $message,
        ];

        return view('contas.show', $data);
    }

    /**
     * Show the form for deleting a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Conta $conta)
    {
        $data = [
            'conta' => $conta,
        ];
        
        return view('contas.delete', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conta $conta)
    {
        //
    }
}
