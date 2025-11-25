<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class EnrollmentsController extends Controller
{
    /**
     * LISTAR TODAS LAS INSCRIPCIONES (solo Admin / Profesor)
     */
    public function index()
    {
        $enrollments = Enrollment::with(['user', 'course'])->get();
        return view('enrollments.index', compact('enrollments'));
    }


    /**
     * FORMULARIO DE CREACIÓN DE INSCRIPCIÓN
     */
    public function create()
    {
        $courses = Course::all();
        $users   = User::all();

        return view('enrollments.create', compact('courses', 'users'));
    }


    /**
     * MÍAS (solo estudiante)
     */
    public function myEnrollments()
    {
        $enrollments = Enrollment::with('course')
            ->where('user_id', Auth::id())
            ->get();

        return view('enrollments.my', compact('enrollments'));
    }


    /**
     * VER INSCRIPCIONES DE UN CURSO (solo profesor/admin)
     */
    public function courseEnrollments($course_id)
    {
        $course = Course::with('enrollments.user')->findOrFail($course_id);
        return view('enrollments.by_course', compact('course'));
    }


    /**
     * CREAR INSCRIPCIÓN
     */
    public function store(Request $request, $courseIdFromRoute = null)
    {
        // Curso desde POST o parámetro
        $course_id = $request->course_id ?? $courseIdFromRoute;
        $user_id   = $request->user_id ?? Auth::id();

        if (!$course_id || !$user_id) {
            return back()->with('error', 'Faltan datos para completar la inscripción.');
        }

        // Evitar duplicados
        if (Enrollment::where('course_id', $course_id)->where('user_id', $user_id)->exists()) {
            return back()->with('error', 'El usuario ya está inscrito en este curso.');
        }

        try {
            Enrollment::create([
                'course_id'   => $course_id,
                'user_id'     => $user_id,
                'enrolled_at' => now(),
                'status'      => 'active',
            ]);

            return redirect()->route('enrollments.index')
                ->with('success', 'Inscripción creada correctamente.');

        } catch (\Exception $ex) {
            Log::error($ex);
            return back()->with('error', 'Error al inscribirse en el curso.');
        }
    }


    /**
     * VER DETALLES
     */
    public function show($id)
    {
        $enrollment = Enrollment::with(['user', 'course'])->findOrFail($id);

        // Regla: el estudiante solo ve sus propias inscripciones
        if (
            Auth::user()->role->name === 'Estudiante' &&
            $enrollment->user_id !== Auth::id()
        ) {
            abort(403, 'No tienes permiso para ver esta inscripción.');
        }

        return view('enrollments.show', compact('enrollment'));
    }


    /**
     * EDITAR ESTADO (vista)
     */
    public function edit($id)
    {
        $enrollment = Enrollment::with(['user', 'course'])->findOrFail($id);

        return view('enrollments.edit', compact('enrollment'));
    }


    /**
     * ACTUALIZAR ESTADO
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $enrollment = Enrollment::findOrFail($id);
        $enrollment->status = $request->status;
        $enrollment->save();

        return redirect()->route('enrollments.index')
            ->with('success', 'Estado actualizado correctamente.');
    }


    /**
     * ELIMINAR
     */
    public function destroy($id)
    {
        try {
            $enrollment = Enrollment::findOrFail($id);
            $enrollment->delete();

            return back()->with('success', 'Inscripción eliminada correctamente.');
        } catch (\Exception $ex) {
            Log::error($ex);
            return back()->with('error', 'Error al eliminar la inscripción.');
        }
    }
}

