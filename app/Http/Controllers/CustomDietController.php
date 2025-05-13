<?php

namespace App\Http\Controllers;

use App\Models\CustomDiet;
use App\Models\DietPlan;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomDietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render(
            'templates/customDiet/Index',
            [
                'title' => 'Dieta Personalizada'
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('templates/customDiet/Create', [
            'title' =>  'Criar dieta'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'meals' => 'required|array',
            'meals.*.products' => 'required|array',
            'meals.*.products.*.quantity' => 'required|string',
            'meals.*.products.*.product' => 'required|string',
            'meals.*.products.*.observation' => 'nullable|string',
        ]);
    
        dd($request->meals);
        CustomDiet::create([
            'meals' => $request->meals,
        ]);
        
        

        return Inertia::render('templates/customDiet/Index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomDiet $customDiet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomDiet $customDiet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomDiet $customDiet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomDiet $customDiet)
    {
        //
    }
}
