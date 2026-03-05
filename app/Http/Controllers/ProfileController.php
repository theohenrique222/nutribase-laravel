<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Profile::all();

        return Inertia::render('students/profiles/index',
            [
                'title' =>  'Dados Pessoais',
                'personalData' =>  $profile,
             ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('students/profiles/create',
        [
            'title' => 'Nova Medida'
        ]);
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         =>  'required|string',
            'description'   =>  'string',
            'height'        =>  'required|numeric',
            'weight'        =>  'required|numeric',
            'arm_l'         =>  'numeric',
            'arm_r'         =>  'numeric',
            'chest'         =>  'numeric',
            'waist'         =>  'required|numeric',
            'scruff'        =>  'required|numeric',
            'thigh_l'       =>  'numeric',
            'thigh_r'       =>  'numeric',
            'calf_l'        =>  'numeric',
            'calf_r'        =>  'numeric',
        ]);

        Profile::create($data);

        return Redirect::route('profile.index')->with('success', 'Medida cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
