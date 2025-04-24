<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonalDatasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('templates/personalDatas/index', ['title' => 'Dados Pessoais']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('templates/personalDatas/create', ['title' => 'Nova medida']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'age' => 'required|integer',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'arm_l' => 'nullable|numeric',
            'arm_r' => 'nullable|numeric',
            'chest' => 'nullable|numeric',
            'waist' => 'nullable|numeric',
            'scruff' => 'nullable|numeric',
            'thigh_l' => 'nullable|numeric',
            'thigh_r' => 'nullable|numeric',
            'calf' => 'nullable|numeric',
        ]);

        PersonalData::create($validated);

        return redirect()->route('personal-datas.index')->with('success', 'Medida salva com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
