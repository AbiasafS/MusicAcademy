<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User; // [IMPORTANTE] Necesario para listar usuarios
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'nullable|integer|min:0',
        ]);

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'duration_minutes' => $request->duration_minutes,
            'published' => $request->has('published'),
        ]);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Curso creado exitosamente.');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'nullable|integer|min:0',
        ]);

        $course->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'duration_minutes' => $request->duration_minutes,
            'published' => $request->has('published'),
        ]);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Curso actualizado exitosamente.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')
            ->with('success', 'Curso eliminado exitosamente.');
    }

    // ---------------------------------------------------
    // NUEVAS FUNCIONES PARA ASIGNAR USUARIOS
    // ---------------------------------------------------

    public function assignStudents(Request $request, Course $course)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
    ]);

    // Evita duplicados
    if ($course->students()->where('user_id', $request->user_id)->exists()) {
        return back()->with('error', 'El estudiante ya está inscrito en este curso.');
    }

    $course->students()->attach($request->user_id, [
        'enrollment_date' => now(),
    ]);

    return back()->with('success', 'Estudiante asignado correctamente.');
}
public function removeStudent(Course $course, User $user)
{
    $course->students()->detach($user->id);

    return back()->with('success', 'Estudiante eliminado del curso.');
}


    public function storeUserAssignment(Request $request)
    {
        // 1. Validamos que lleguen IDs válidos
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // 2. Buscamos el curso
        $course = Course::findOrFail($request->course_id);

        // 3. Guardamos la relación
        // syncWithoutDetaching evita que se duplique si ya estaba asignado
        $course->students()->syncWithoutDetaching([$request->user_id]);

        return redirect()->route('admin.courses.assign-users')
            ->with('success', 'Estudiante asignado al curso correctamente.');
    }
public function assignUsers(Course $course)
{
    $students = \App\Models\User::all();

    return view('admin.courses.assign-users', [
        'course' => $course,
        'students' => $students,
    ]);
}

public function assign(Request $request, Course $course)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
    ]);

    // Guardar en la tabla pivote
    $course->students()->syncWithoutDetaching([
        $request->user_id => [
            'enrollment_date' => now(),
        ],
    ]);

    return back()->with('success', 'Estudiante asignado correctamente.');
}

}