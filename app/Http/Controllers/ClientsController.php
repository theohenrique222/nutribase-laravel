<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Diet;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        $diet = Diet::all();

        return view('pages.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'age'       => 'required|numeric|min:1',
            'gender'    => 'required|numeric',
            'weight'    => 'required|numeric|min:1',
            'height'    => 'required|numeric',
            'waist'     => 'required|numeric|min:1',
            'activity'  => 'required|numeric',
            'goal'      => 'required|numeric',
        ]);

        Client::create([
            'name'      =>      $request->name,
            'age'       =>      $request->age,
            'gender'    =>      $request->gender,
            'weight'    =>      $request->weight,
            'height'    =>      $request->height,
            'waist'     =>      $request->waist,
            'activity'  =>      $request->activity,
            'goal'      =>      $request->goal,
        ]);

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $clients = Client::findOrFail($id);

        return view('pages.clients.show', compact('clients'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $clients = Client::findOrFail($id);

        return view('pages.clients.edit', compact('clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $clients = Client::findOrFail($id);

        $data = $request->validate([
            'name'      => 'required|string',
            'age'       => 'required|numeric|min:1',
            'gender'    => 'required|numeric',
            'weight'    => 'required|numeric|min:1',
            'height'    => 'required|numeric',
            'waist'     => 'required|numeric|min:1',
            'activity'  => 'required|numeric',
            'goal'      => 'required|numeric',
        ]);

        $clients->update($data);

        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $clients = Client::findOrFail($id);

        $clients->delete();

        return redirect()->route('clients.index');
    }
}
