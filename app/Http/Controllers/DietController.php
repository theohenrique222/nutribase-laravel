<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Diet;
use App\Models\PersonalData;
use App\Models\Product;
use Illuminate\Http\Request;

class DietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diets = Diet::all();


        return view('pages.diet.index', compact('diets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients    =   Client::all();
        $products   =   Product::all();

        return view('pages.diet.create', compact('clients', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $diet = Diet::create([
            'client_id' => $request->client_id,
            'name'      =>  $request->name,
        ]);
        
        

        foreach ($request->products as $item) {
            $diet->products()->attach($item['product_id'], [
                'quantity' => $item['quantity'],
                'observation' => $item['observation'],
            ]);
        }

        return redirect()->route('diet.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Diet $diet)
    {
        return view('pages.diet.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $diet = Diet::findOrFail($id);

        return view('pages.diet.edit', compact('diet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $diet = Diet::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
        ]);

        $diet->update([
            'name' => $request->name,
        ]);

        return redirect()->route('diet.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $diet = Diet::findOrFail($id);
        $diet->delete();

        return redirect()->route('diet.index');
    }
}
