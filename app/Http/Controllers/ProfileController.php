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
            'title' => 'Completar dados pessoais',
            'profile' => $profile,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profile = Profile::where('user_id', auth()->id())->get();

        if ($profile->isEmpty()) {
            return Inertia::render('students/profiles/create',
            [
                'title' => 'Completar dados pessoais',
                'profile' => $profile,
            ]);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'          =>  'required|string',
            'nickname'      =>  'nullable|string',
            'date_birth'    =>  'required|date',
            'gender'        =>  'required|string',
        ]);

        $validated['user_id'] = auth()->user()->id;

        Profile::create($validated);

        return Redirect::route('dashboard');
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
