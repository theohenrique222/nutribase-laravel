<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CalculationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected function calculateTMB($weight, $height, $age, $gender = 'male')
    {
        if ($gender === 'female') {
            return round(655 + (9.6 * $weight) + (1.8 * $height) - (4.7 * $age), 2);
        }

        return round(66 + (13.7 * $weight) + (5 * $height) - (6.8 * $age), 2);
    }

    protected function calculateWaterIntake($weight)
    {
        return round($weight * 35);
    }

    public function index(Request $request)
    {
        $personalData = PersonalData::all()->map(function ($data) 
        {
            $data->tmb          = $this->calculateTMB($data->weight, $data->height, $data->age, $data->gender);
            $data->waterIntake  = $this->calculateWaterIntake($data->weight);
            return $data;
        });

        return Inertia::render(
            'templates/calculation/index',
            [
                'title'             =>  'Calculadora',
                'personalData'      =>  $personalData
            ]
        );
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
    public function show(Calculation $calculation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calculation $calculation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calculation $calculation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calculation $calculation)
    {
        //
    }
}
