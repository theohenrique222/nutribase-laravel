<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Diet;
use App\Models\Measurements;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $coaches = Coach::all();
        if (!$coaches) {
            return abort(403, 'em desenvolvimento');
        }
        $coach       =   Coach::where('user_id', auth()->id())->first();
        $students    =   Student::where('coach_id', $coach->id)->count() ?? 0;
        $diets       =  Diet::where('coach_id', $coach->id)->count() ?? 0;
        $measurements = Measurements::all()->count() ?? 0;

        return Inertia::render('Dashboard', [
            'title' => 'Painel de controle',
            'students' => $students,
            'diets' => $diets,
            'measurements' => $measurements,
        ]);
    }
}
