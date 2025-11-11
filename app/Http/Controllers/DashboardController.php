<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $user = auth()->user();
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalSections = Section::count();

        // Mapeo de role_id a nombre de rol
        $roleNames = [
            1 => 'Admin',
            2 => 'Profesor',
            3 => 'Estudiante',
        ];

        $roleId = $user->role_id;
        $roleName = $roleNames[$roleId] ?? 'Sin rol asignado';

        // Obtener datos según el rol del usuario
        $userData = [
            'totalUsers' => $totalUsers,
            'totalCourses' => $totalCourses,
            'totalSections' => $totalSections,
            'userRole' => $roleName,
        ];

        // Si es profesor (role_id = 2), mostrar solo sus cursos
        if ($roleId === 2) {
            $userData['myCourses'] = $user->courses()->count();
        }

        // Si es estudiante (role_id = 3), mostrar cursos enrollados
        if ($roleId === 3) {
            $userData['enrolledCourses'] = $user->courses()->count();
        }

        return view('dashboard', $userData);
    }
}
