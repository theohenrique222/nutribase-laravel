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
        $value = $gender === 'female'
            ? round(655 + (9.6 * $weight) + (1.8 * $height) - (4.7 * $age), 2)
            : round(66 + (13.7 * $weight) + (5 * $height) - (6.8 * $age), 2);

        return [
            'title'        => 'Taxa Metabólica Basal',
            'subtitle'     => 'Quantidade de calorias que o corpo gasta em repouso',
            'value'        => $value,
        ];
    }


    protected function waterIntake($weight)
    {
        $value = $weight * 35;

        return ['value' => $value,];
    }

    protected function calculateIMC($weight, $height)
    {
        return round(($weight * 100) / ($height * $height), 2);
    }

    protected function calculateProteins($weight)
    {
        $factor = 2.2;
        return [
            'title'     => 'Proteínas',
            'subtitle'  => 'Lorem ipsun Proteinas',
            'value'     => round($weight * $factor) . ' g'
        ];
    }

    public function index(Request $request)
    {
        $personalData = PersonalData::all()->map(function ($data) {
            $data->tmb          = $this->calculateTMB($data->weight, $data->height, $data->age, $data->gender);

            $waterIntakeData    = $this->waterIntake($data->weight);
            $data->waterIntake  =
                [
                    'title'     => 'Água Diária',
                    'subtitle'  => 'Quantidade de água que seu corpo precisa para realizar funções',
                    'value'     => round(($waterIntakeData['value'] / 1000), 1) . ' litros'
                ];

            $data->imc          = [
                'title'         =>  'Massa corporal IMC',
                'subtitle'      =>  'lorem ipsun IMC',
                'value'         =>  $this->calculateIMC($data->weight, $data->height)
            ];

            $data->proteins = $this->calculateProteins($data->weight);

            return $data;
        });

        return Inertia::render(
            'templates/calculation/index',
            [
                'title'             =>  'Análise Corporal',
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
