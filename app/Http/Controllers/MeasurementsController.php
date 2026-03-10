<?php

namespace App\Http\Controllers;

use App\Models\Measurements;
use App\Models\MeasurementsHistory;
use App\Models\Profile;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MeasurementsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $measurements   = Measurements::where('user_id', auth()->id())->get();
        $hasMeasurements   = Measurements::where('user_id', auth()->id())->exists();

        return Inertia::render('students/measurements/index', [
            'title'             => 'Medições',
            'measurements'      => $measurements,
            'hasMeasurement'    => $hasMeasurements,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Profile::where('user_id', auth()->id())->first()) {
            return redirect()
                ->route('profile.create');
        }

        if (Measurements::where('user_id', auth()->id())->exists())
        {
            abort(403, 'Não é possível adicionar outra medição');
        }

        return Inertia::render('students/measurements/create', [
            'title' =>  'Cadastrar Medições'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
    public function show(Measurements $measurements)
    {
        //
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
