<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Account\Entities\Account;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'accounts' => Account::all(),
        ];

        return view('account::accounts.index', $data);
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

        return view('account::accounts.create', $data);
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
            'name' => 'required|',
            'iban' => 'required|size:25|unique:accounts,iban',
        ]);

        Account::create($request->all());

        return redirect('/accounts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        $data = [
            'account' => $account,
        ];

        return view('account::accounts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        $data = [
            'account' => $account,
        ];

        return view('account::accounts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $this->validate($request, [
            'name' => 'required|',
            'iban' => 'required|size:25|unique:contas,iban,' . $account->id,
        ]);

        $r = $account->update($request->all());

        if($r == 0) {
            $message = [
                'type' => 'warning',
                'text' => 'Falha na edição de ' . $account->name . '.',
            ];

        } else {
            $message = [
                'type' => 'success',
                'text' => 'Sucesso na edição de ' . $account->name  . '.',
            ];

        }

        $data = [
            'account' => $account,
            'message' => $message,
        ];

        return view('account::accounts.show', $data);
    }

    /**
     * Show the form for deleting a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Account $account)
    {
        $data = [
            'account' => $account,
        ];

        return view('account::accounts.delete', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conta  $conta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
