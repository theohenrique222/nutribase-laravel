<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use App\Models\DietPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DietPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $calculations = Calculation::all();

        return Inertia::render('templates/diet/Index', 
        [
            'title'         =>  'Dieta',
            'calculations'  =>  $calculations,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DietPlan $dietPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DietPlan $dietPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DietPlan $dietPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DietPlan $dietPlan)
    {
        //
    }
}
