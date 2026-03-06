<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use function Pest\Laravel\get;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Profile::where('user_id', auth()->id())->get();

        return Inertia::render('students/profiles/index', [
            'title' => 'Dados Pessoais',
            'profile' => $profile,
        ]);
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

        $validated = $request->validate([
            'title'         =>  'required|string',
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

        $validated['user_id'] = auth()->user()->id;

        Profile::create($validated);

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
        $profile = Profile::where(auth()->user()->id)->get;

        return Inertia::render('students/profiles/edit', [
//            'title' = 'Atualizar medidas',
            'profile' => $profile,
        ]);
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
