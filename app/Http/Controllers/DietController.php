<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Diet;
use App\Models\Food;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students   =   Student::with('user')->get();

        $coach = Coach::where('user_id', auth()->id())->first();

        if (!$coach) {
            return Inertia::render('diet/Index', [
                'title' => 'Dietas',
                'diets' => [], // usuário não é coach, retorna vazio
                'students' => $students
            ]);
        }

        $diets = Diet::with([
            'student',
            'foods:id,name' // só traz id e name dos alimentos
        ])->where('coach_id', $coach->id)->get();


        return Inertia::render('diet/Index', [
            'title' => 'Dietas',
            'diets' => $diets,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $foods      =   Food::all();
        $coach      =   Coach::where('user_id', auth()->id())->first();
        $students   =   Student::with('user')->where('coach_id', $coach->id)->get();

        return Inertia::render('diet/Create', [
            'title'     => 'Criar Dieta',
            'foods'     => $foods,
            'coach'     => $coach,
            'students'  => $students
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $coachId = Coach::where('user_id', auth()->id())->value('id');

        $validated = $request->validate([
            'student_id' => 'nullable|exists:students,id',
            'objective' => 'nullable|string|max:255',
            'calories' => 'nullable|integer',
            'meals' => 'required|array',
            'meals.*.products' => 'required|array',
            'meals.*.products.*.quantity' => 'nullable|numeric',
            'meals.*.products.*.food' => 'required|integer',
            'meals.*.products.*.observation' => 'nullable|string',
        ]);

        foreach ($validated['meals'] as $meal) {
            foreach ($meal['products'] as $product) {

                $diet = Diet::create([
                    'coach_id' => $coachId,
                    'student_id' => $validated['student_id'],
                    'objective' => $validated['objective'],
                    'calories' => $validated['calories'],
                    'meals' => $validated['meals'],
                ]);
            }
        }
        foreach ($validated['meals'] as $mealIndex => $meal) {
            foreach ($meal['products'] as $product) {
                DB::table('diet_food')->insert([
                    'diet_id' => $diet->id,
                    'food_id' => $product['food'],
                    'meal_number' => $mealIndex,
                    'quantity' => $product['quantity'],
                    'observation' => $product['observation'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        return redirect(route('diet.index'));
    }
    /**
     * Display the specified resource.
     */
    public function show($student_id)
    {
        $coach = Coach::where('user_id', auth()->id())->first();
        if (!$coach) abort(403);

        $student = Student::with('user')->findOrFail($student_id);

        $diets = Diet::with(['foods:id,name'])
            ->where('coach_id', $coach->id)
            ->where('student_id', $student->id)
            ->get();

        if ($diets->isEmpty()) {
            return redirect(route('diet.create', ['student_id' => $student->id]))
                ->with( 'Este aluno ainda não possui dieta. Crie uma agora.');
        }
        return Inertia::render('diet/Index', [
            'title' => 'Dietas de ' . $student->user->name,
            'student' => $student,
            'diets' => $diets,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diet $diet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diet $diet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diet $diet)
    {
        //
    }
}
