<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Measurements;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use function PHPUnit\Framework\isEmpty;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coach      =   Coach::where('user_id', auth()->id())->first();
        $students = Student::forCoach( $coach->id);


        if (!$coach) {
            return Inertia::render('students/index', [
                'title'     =>  'Alunos',
                'students'  =>  $students
            ]);
        }


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

        return back()->with('success', 'Aluno cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $coach = Coach::where('user_id', auth()->id())->first();
        $students = Student::forCoach($coach->id);
        $measurements   = Measurements::where('user_id', auth()->id())->get();
        $hasMeasurements   = Measurements::where('user_id', auth()->id())->exists();

        if (isEmpty($hasMeasurements)) {
            return redirect()->route('measurements.show', $student)->with('Para prosseguir, insira as medidas do aluno');
        }

        return Inertia::render('students/Show', [
           'title'     =>  'Informações do Aluno',
            'students'  =>  $students,
            'measurements'   =>  $measurements,
            'hasMeasurements'   =>  $hasMeasurements
        ]);
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
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $student->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->back();
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
