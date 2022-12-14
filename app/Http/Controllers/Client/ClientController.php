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
            ])->orderBy('id', 'desc')
            ->get()
            ->toArray();
        $socialNetwork = SocialNetwork::on()->get()->toArray();
        return view('client.list_clients', [
            'clients' => $clients,
            'social_network' => $socialNetwork
        ]);
    }


    public function create()
    {
        $socialNetwork = SocialNetwork::on()->get();

        return view('client.client', [
            'socialNetwork' => $socialNetwork,
        ]);
    }


    public function store(Request $request)
    {
        $attr = [
            'name' => $request->name,
            'dialog_location' => $request->dialog_location ?? null,
            'scope_work' => $request->scope_work ?? null,
            'company_name' => $request->company_name ?? null,
            'site' => $request->site ?? null,
            'characteristic' => $request->characteristic ?? null,
        ];
        Client::on()->create($attr);
        return redirect()->back();

    }


    public function show($id)
    {
        //
    }


    public function edit($client)
    {
        $clients = Client::on()
            ->find($client)
            ->toArray();
        $socialNetwork = SocialNetwork::on()
            ->get()
            ->toArray();


        return view('client.client_edit', [
            'clients' => $clients,
            'socialNetwork' => $socialNetwork,

        ]);
    }


    public function update(Request $request, $client)
    {
        $attr = [
            'name' => $request->name ?? null,
            'scope_work' => $request->scope_work ?? null,
            'company_name' => $request->company_name ?? null,
            'site' => $request->site ?? null,
            'characteristic' => $request->characteristic ?? null,
        ];

        Client::on()->where('id', $client)->update($attr);
        return redirect()->back()->with(['success' => '???????????? ?????????????? ??????????????????.']);

    }


    public function destroy($id)
    {
        //
    }
}
