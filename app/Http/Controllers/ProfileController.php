<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use function Pest\Laravel\get;
use function PHPUnit\Framework\isEmpty;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('students/profiles/index', [
            'title' => 'Completar dados pessoais',
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        $profile = Profile::where('user_id', auth()->id())->get();
//
//        if ($profile->isEmpty()) {
//        }
        return Inertia::render('students/profiles/create',
        [
            'title' => 'Completar dados pessoais',
//            'profile' => $profile,
        ]);

//        return redirect()->back();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nickname'      =>  'nullable|string',
            'date_birth'    =>  'required|date',
            'gender'        =>  'required|string',
        ]);

        $validated['student_id'] = auth()->user()->student->id;

        Profile::create($validated);

        return redirect()->route('dashboard');
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
