<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Client;
use App\Models\Client\SocialNetwork;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }


    public function create()
    {

        $socialnetwork = SocialNetwork::on()->get();

        return view('client.client', [
            'socialnetwork' => $socialnetwork,
        ]);

    }


    public function store(Request $request)
    {
        $attr = [
            'name'=>$request->name ?? null,
            'dialog_location'=>$request->dialog_location ?? null,
            'scope_work'=>$request->scope_work ?? null,
            'company_name'=>$request->company_name ?? null,
            'characteristic'=>$request->characteristic ?? null,
        ];

        // $attr = $request->all();
        // unset($attr['_token']);

        Client::on()->create($attr);
        return redirect()->back();

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
