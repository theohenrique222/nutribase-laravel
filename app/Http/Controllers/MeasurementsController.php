<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Measurements;
use App\Models\MeasurementsHistory;
use App\Models\Profile;
use App\Models\Student;
use App\Services\NutritionCalculator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function PHPUnit\Framework\isEmpty;

class MeasurementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $measurements = Measurements::where('user_id', auth()->id())->get();
        $hasMeasurements = Measurements::where('user_id', auth()->id())->exists();
//        $measurement = Measurements::where('user_id', auth()->id())->latest()->first();
//        $profile = Profile::where('user_id', auth()->id())->latest()->first();
//        $gender = $profile->gender;
//        $weight = $measurement->weight;
//        $height = $measurement->height;
//        $age = Carbon::parse($profile->date_birth)->age;
//        $calcWater = ($weight * 35) / 1000;
//
//        $calcBasal = null;
//
//        if ($measurement) {
//
//            if ($gender === 'male') {
//                $calcBasal = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
//            }
//
//            if ($gender === 'female') {
//                $calcBasal = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
//            }
//
//            $calcProteins = $weight * 1.6;
//            $fat = $weight * 0.8;
//
//            $calcCarbs = ($calcBasal - ($calcProteins * 4 + $fat * 9)) / 4;
//        }

        return Inertia::render('students/measurements/index', [
            'title'             => 'Medições',
            'measurements'      => $measurements,
            'hasMeasurement'    => $hasMeasurements,
//            'calcBasal'         => $calcBasal,
//            'calcProteins'      => $calcProteins,
//            'calcCarbs'         => $calcCarbs,
//            'calcWater'         => $calcWater,
//            'calcFat'           => $fat,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $coach = Coach::  where('user_id', auth()->id())->first();
        $students = Student::current();

        if (Measurements::where('user_id', auth()->id())->exists())
        {
            abort(403, 'Não é possível adicionar outra medição');
        }

        if ($coach) {
            $studentsName   =   Student::with('user')->where('coach_id', $coach->id)->get();
            return Inertia::render('students/measurements/create',
                [
                    'title'     =>  'Cadastrar Medições',
                    'students'  =>  $studentsName,
                    'isCoach'   =>  $coach ? true : false,

                ]
            );
        }
        if ($students) {
            return Inertia::render('students/measurements/create',
                [
                    'title' =>  'Cadastrar Medições',
                ]
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, NutritionCalculator $calculatorm, Student $student)
    {
        dd($request->all());
        $validated = $request->validate([
            'name'          =>  'required|string',
            'description'   =>  'nullable|string',
            'height'        =>  'required|numeric',
            'weight'        =>  'required|numeric',
            'arm_l'         =>  'nullable|numeric',
            'arm_r'         =>  'nullable|numeric',
            'chest'         =>  'nullable|numeric',
            'waist'         =>  'required|numeric',
            'scruff'        =>  'required|numeric',
            'thigh_l'       =>  'nullable|numeric',
            'thigh_r'       =>  'nullable|numeric',
            'calf_l'        =>  'nullable|numeric',
            'calf_r'        =>  'nullable|numeric',
        ]);

        $student = Student::findOrFail($request->student_id);
        dd($student);
        $validated['student_id'] = $student->id;
        dd($validated);

        $profile = $student->user->profile;
        $calculations = $calculator->calculate($validated);

        dd($calculations);
        $measurement = Measurements::create([
            ...$validated,
            ...$calculations,
        ]);

        $measurementExists = Measurements::where('user_id', auth()->id())->exists();

        $measurement = Measurements::create($validated);

        if (!$measurementExists) {
            $validated['measurement_id'] = $measurement->id;
            MeasurementsHistory::create($validated);
        }

        return redirect(route('measurements.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Measurements $measurements, Student $student)
    {
        $measurements = Measurements::where('user_id', auth()->id())->get();
        $hasMeasurements = Measurements::where('user_id', auth()->id())->exists();
        $measurement = Measurements::where('user_id', auth()->id())->latest()->first();
        $coach = Coach::  where('user_id', auth()->id())->first();

//        if (!$hasMeasurements) {
//            return redirect()->route('measurements.create', [
//                'student_id' => $student->id,
//            ]);
//        }


        return Inertia::render('students/measurements/index', [
            'title'             => 'Medições',
            'measurements'      => $measurements,
            'hasMeasurement'    => $hasMeasurements,
            'coach'             => $coach,
            'student'          => $student,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Measurements $measurement)
    {
        return Inertia::render('students/measurements/edit', [
            'title' =>  'Atualização',
            'measurement' => $measurement,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Measurements $measurement)
    {
        $validated = $request->validate([
            'name'          =>  'required|string',
            'description'   =>  'nullable|string',
            'height'        =>  'required|numeric',
            'weight'        =>  'required|numeric',
            'arm_l'         =>  'nullable|numeric',
            'arm_r'         =>  'nullable|numeric',
            'chest'         =>  'nullable|numeric',
            'waist'         =>  'required|numeric',
            'scruff'        =>  'required|numeric',
            'thigh_l'       =>  'nullable|numeric',
            'thigh_r'       =>  'nullable|numeric',
            'calf_l'        =>  'nullable|numeric',
            'calf_r'        =>  'nullable|numeric',
        ]);

        $validated['user_id'] = auth()->id();

        $validated['measurement_id'] = $measurement->id;

        MeasurementsHistory::create($validated);

        $measurement->update($validated);

        return redirect()->route('measurements.index')->with('success', 'Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Measurements $measurements)
    {
        //
    }
}
