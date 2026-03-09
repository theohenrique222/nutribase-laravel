<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coach      =   Coach::where('user_id', auth()->id())->first();
        $students   =   Student::with('user')->get();

        if (!$coach) {
            return Inertia::render('students/index', [
                'title'     =>  'Alunos',
                'students'  =>  $students
            ]);
        }
        $students   =   Student::with('user')
            ->where('coach_id', $coach->id)
            ->get();

        return Inertia::render('students/index', [
            'title'     =>  'Alunos',
            'students'  =>  $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('students/create', [
            'title' => 'Cadastrar Aluno'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      =>  'required|string|max:255',
            'email'     =>  'required|string|email|max:255|unique:users,email',
            'password'  =>  'required|string|min:8|confirmed',
        ]);


        $user = User::create([
            'name'      =>  $validated['name'],
            'email'     =>  $validated['email'],
            'password'  =>  Hash::make($validated['password']),
        ]);

        $coach = Coach::where('user_id', auth()->user()->id)->first();

        Student::create([
            'user_id' => $user->id,
            'coach_id' => $coach->id,
        ]);

        return Redirect::route('students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return Redirect::route('students.index')->with('success', 'Aluno removido com sucesso!');
    }
}
