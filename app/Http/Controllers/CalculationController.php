<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function PHPUnit\Framework\returnSelf;

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
        $factor =  35;

        return [
            'title'             => 'Água diaria',
            'subtitle'          => 'Quantidade de água que seu corpo precisa para realizar funções',
            'value'             => round($weight * $factor / 1000, 3),
        ];
    }

    protected function calculateIMC($weight, $height)
    {
        $heightMts = ($height / 100);
        return [
            'title'             => 'IMC',
            'subtitle'          => 'Indice de Massa corporal',
            'value'             => round($weight / ($heightMts * $heightMts)),
        ];
    }

    protected function calculateProteins($weight)
    {
        $factor = 2.2;

        return [
            'title'             => 'Proteínas',
            'subtitle'          => 'Quantidade de proteínas diarias que seu corpo precisa',
            'value'             => round($weight * $factor)
        ];
    }

    protected function calculateCarbohydrates($weight)
    {
        $factor = 6;

        return [
            'title'             => 'Carboidratos',
            'subtitle'          => 'Quantidade de carboidratos diarios que seu corpo precisa ingerir',
            'value'             => round($weight * $factor)
        ];
    }

    protected function calculateFats($weight)
    {
        $factor = 1;

        return [
            'title'            => 'Gordura',
            'subtitle'         => 'Quantidade de gorduras que seu corpo precisa no dia',
            'value'            => round($weight * $factor)
        ];
    }

    public function index(Request $request)
    {
        $personalData = PersonalData::all()->map(function ($data) {
            $data->tmb              = $this->calculateTMB($data->weight, $data->height, $data->age, $data->gender);
            $data->waterIntake      = $this->waterIntake($data->weight);
            $data->imc              = $this->calculateIMC($data->weight, $data->height, $data->heightMt);
            $data->proteins         = $this->calculateProteins($data->weight);
            $data->carbohydrates    = $this->calculateCarbohydrates($data->weight);
            $data->fats             = $this->calculateFats($data->weight, $data->height);

            return $data;
        });

        $calculations = Calculation::all();

        return Inertia::render(
            'templates/calculation/index',
            [
                'title'         =>  'Análise Corporal',
                'personalData'  =>  $personalData,
                'calculations'  =>  $calculations
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
        
        
        $request->validate([
            'tmb'           =>  'required|numeric',
            'proteins'      =>  'required|numeric',
            'carbohydrates' =>  'required|numeric',
            'fat'           =>  'required|numeric',
            'water_intake'  =>  'required|numeric',
            'imc'           =>  'required|numeric',
        ]);
        
        Calculation::create([
            'tmb'           =>  $request->tmb,
            'proteins'      =>  $request->proteins,
            'carbohydrates' =>  $request->carbohydrates,
            'fat'           =>  $request->fat,
            'water_intake'  =>  $request->water_intake,
            'imc'           =>  $request->imc,

        ]);
        
        // return redirect()->back()->with('success', 'Cálculo salvo com sucesso!');
        return to_route('personal-datas.index')->with('success', 'Cálculo salvo com sucesso!');

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
