<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Section;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role->name;

        // Datos usados por los 3 dashboards
        $data = [
            'totalUsers'       => User::count(),
            'totalCourses'     => Course::count(),
            'totalSections'    => Section::count(),
            'totalEnrollments' => Enrollment::count(),
        ];

        // Dashboard profesor
        if ($role === 'Profesor') {
            // Profesor: solo ver cuántos cursos existen
            $data['myCourses'] = Course::count();

// Profesor: ver total de inscripciones generales
            $data['myEnrollments'] = Enrollment::count();

        }

        // Dashboard estudiante
        if ($role === 'Estudiante') {
            $data['myEnrollments'] = Enrollment::where('user_id', Auth::id())->count();
        }

        return view('dashboard.admin', [
        'totalUsers' => User::count(),
        'totalCourses' => Course::count(),
        'totalSections' => Section::count(),
        'totalEnrollments' => Enrollment::count(),
        'recentActivity' => [
        'Nuevo usuario registrado',
        'Se actualizó un curso',
        'Se eliminó una sección'
    ]
]);
    }
}
