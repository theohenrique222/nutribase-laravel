<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiController extends Controller
{
    public function generateDiet(Request $request)
    {
        $response = Http::withHeaders(
            [
                'Authorization'         => 'Bearer ' . env('OPENROUTER_API_KEY'),
                'Content-Type'          => 'application/json',
            ]
        )->post(
            'https://openrouter.ai/api/v1/chat/completions',
            [
                'model'                 =>  'openai/gpt-3.5-turbo',
                'messages'              =>  [
                    [
                        [
                            'role'      =>  'system',
                            'content'   =>  'Você é um nutricionista especializado em criar dietas personalizadas com base em objetivos, nível de atividade e alimentos preferidos. Responda com uma dieta detalhada e balanceada.'
                        ],
                        [
                            'role'      =>  'user',
                            'content'   =>  "Meu objetivo é {$request->goal}. Nível de atividade física: {$request->activity}. Alimentos que desejo incluir: " . implode(', ', array_merge(
                                $request->selectedFoods['proteins'] ?? [],
                                $request->selectedFoods['carbs'] ?? [],
                                $request->selectedFoods['salads'] ?? [],
                                $request->selectedFoods['fats'] ?? []
                            ))
                        ],
                    ]

                ],
            ]
        );

        return response()->json($response->json());
    }
}
