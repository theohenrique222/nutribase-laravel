<?php

namespace App\Http\Controllers;

use App\Models\Calculation;
use App\Models\DietPlan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class DietPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function generate(Request $request)
    {
        $prompt = $request->input('prompt');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
            'HTTP-Referer' => 'http://localhost', // use seu domínio real em produção
            'Content-Type' => 'application/json',
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'openchat/openchat-3.5',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        return response()->json([
            'message' => $response['choices'][0]['message']['content'] ?? 'Erro ao gerar dieta',
        ]);
    }

    public function index()
    {
        return Inertia::render('templates/diet/Index', [
            'title' => 'Plano Alimentar',
            'diet' => session('diet') // para mostrar o resultado
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $calculations = Calculation::all();

        return Inertia::render(
            'templates/diet/Create',
            [
                'title'         =>  'Dieta',
                'calculations'  =>  $calculations,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'goal' => 'required|string',
            'activity' => 'required|string',
            'selectedFoods' => 'required|array',
        ]);

        $prompt = "Crie uma dieta para o objetivo: {$data['goal']}, atividade: {$data['activity']}, com os alimentos: " .
            implode(', ', array_merge(
                $data['selectedFoods']['proteins'] ?? [],
                $data['selectedFoods']['carbs'] ?? [],
                $data['selectedFoods']['salads'] ?? [],
                $data['selectedFoods']['fats'] ?? []
            ));

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
            'HTTP-Referer' => 'https://seusite.com', // obrigatório para OpenRouter
            'X-Title' => 'nutribase-dieta',           // nome do seu projeto
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'openai/gpt-3.5-turbo', // ou outro modelo disponível
            'messages' => [
                ['role' => 'system', 'content' => 'Você é um nutricionista que gera dietas personalizadas.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        $generatedDiet = $response->json('choices.0.message.content');

        // Você pode salvar no banco ou redirecionar com o resultado
        return redirect()->route('diet-plan.index')->with('diet', $generatedDiet);
    }


    /**
     * Display the specified resource.
     */
    public function show(DietPlan $dietPlan)
    {
        
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
