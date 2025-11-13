<?php

namespace App\Http\Controllers;

use App\Models\PersonalData;
use Illuminate\Http\Request;

class PersonalDatasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personals = PersonalData::all();

        return view('pages.personal_data.index', compact('personals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.personal_data.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      =>      'required|string',
            'age'       =>      'required|numeric|min:1',
            'gender'    =>      'required|numeric',
            'weight'    =>      'required|numeric|min:1',
            'height'    =>      'required|numeric',
            'waist'     =>      'required|numeric|min:1',
            'activity'  =>      'required|numeric',
            'goal'      =>      'required|numeric'
        ]);

        PersonalData::create([
            'name'      =>      $request->name,
            'age'       =>      $request->age,
            'gender'    =>      $request->gender,
            'weight'    =>      $request->weight,
            'height'    =>      $request->height,
            'waist'     =>      $request->waist,
            'activity'  =>      $request->activity,
            'goal'      =>      $request->goal,
        ]);

        return redirect()->route('personal.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $personal = PersonalData::findOrFail($id);

        return view('pages.personal_data.show', compact('personal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $personal = PersonalData::findOrFail($id);

        return view('pages.personal_data.edit', compact('personal'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $personal = PersonalData::findOrFail($id);

        $data = $request->validate([
            'name'      =>  'required|string|max:255',
            'age'       =>  'required|integer',
            'gender'    =>  'required|integer',
            'weight'    =>  'required|numeric',
            'height'    =>  'required|numeric',
            'waist'     =>  'required|numeric',
            'activity'  =>  'required|integer',
            'goal'      =>  'required|integer',
        ]);

        $personal->update($data);

        return redirect()->route('personal.index')->with('success', 'Dados atualizados com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $personals = PersonalData::findOrFail($id);
        
        $personals->delete();

        return redirect()->route('personal.index');
    }
}
