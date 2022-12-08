<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Client;
use App\Models\Client\SocialNetwork;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {

        $clients = Client::on()
        ->with([
        'socialNetwork'
        ])
        ->get()
        ->toArray();
        $socialnetwork = SocialNetwork::on()->get()->toArray();
        return view('client.list_clients', [
            'clients'=>$clients,
            'social_network' => $socialnetwork
        ]);

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
            'name'=>$request->name,
            'dialog_location'=>$request->dialog_location ?? null,
            'scope_work'=>$request->scope_work ?? null,
            'company_name'=>$request->company_name ?? null,
            'site'=>$request->site ?? null,
            'characteristic'=>$request->characteristic ?? null,
        ];

        // dd($attr);
        Client::on()->create($attr);
        return redirect()->back();

    }


    public function show($id)
    {
        //
    }


    public function edit($client)
    {
        return view('client.client_edit');
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
