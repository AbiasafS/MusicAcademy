<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
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
            'title'             => 'required|string|max:255',
            'description'       => 'nullable|string',
            'price'             => 'required|numeric|min:0',
            'duration_minutes'  => 'nullable|integer|min:0',
        ]);

        Course::create([
            'title'            => $request->title,
            'description'      => $request->description,
            'price'            => $request->price,
            'duration_minutes' => $request->duration_minutes,
            'published'        => $request->has('published'),
        ]);

        // ALERTA SWEETALERT2
        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Curso creado',
            'text'  => 'El curso fue creado exitosamente.',
            'timer' => 3000
        ]);

        return redirect()->route('admin.courses.index');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'price'            => 'required|numeric|min:0',
            'duration_minutes' => 'nullable|integer|min:0',
        ]);

        // ------------ VALIDACIÓN SIN CAMBIOS ------------
        if (
            $course->title == $request->title &&
            $course->description == $request->description &&
            $course->price == $request->price &&
            $course->duration_minutes == $request->duration_minutes &&
            $course->published == $request->has('published')
        ) {

            session()->flash('swal', [
                'icon'  => 'info',
                'title' => 'Sin cambios',
                'text'  => 'No se detectaron modificaciones para actualizar.',
                'timer' => 3500
            ]);

            return redirect()->route('admin.courses.edit', $course);
        }
        // -------------------------------------------------

        $course->update([
            'title'            => $request->title,
            'description'      => $request->description,
            'price'            => $request->price,
            'duration_minutes' => $request->duration_minutes,
            'published'        => $request->has('published'),
        ]);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Curso actualizado',
            'text'  => 'El curso fue actualizado exitosamente.',
            'timer' => 3000
        ]);

        return redirect()->route('admin.courses.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Curso eliminado',
            'text'  => 'El curso fue eliminado correctamente.',
            'timer' => 3000
        ]);

        return redirect()->route('admin.courses.index');
    }

    // ---------------------------------------------------
    // ASIGNAR ESTUDIANTES
    // ---------------------------------------------------

    public function assignStudents(Request $request, Course $course)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);

        // Evitar duplicados
        if ($course->students()->where('user_id', $request->user_id)->exists()) {

            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'Ya inscrito',
                'text'  => 'El estudiante ya está inscrito en este curso.',
                'timer' => 3000
            ]);

            return back();
        }

        $course->students()->attach($request->user_id, [
            'enrollment_date' => now(),
        ]);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Asignación correcta',
            'text'  => 'Estudiante asignado exitosamente.',
            'timer' => 3000
        ]);

        return back();
    }

    public function removeStudent(Course $course, User $user)
    {
        $course->students()->detach($user->id);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Estudiante removido',
            'text'  => 'El estudiante fue eliminado del curso.',
            'timer' => 3000
        ]);

        return back();
    }

    public function storeUserAssignment(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'user_id'   => 'required|exists:users,id',
        ]);

        $course = Course::findOrFail($request->course_id);

        $course->students()->syncWithoutDetaching([$request->user_id]);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Asignado',
            'text'  => 'Estudiante asignado correctamente.',
            'timer' => 3000
        ]);

        return redirect()->route('admin.courses.assign-users');
    }

    public function assignUsers(Course $course)
    {
        $students = User::all();

        return view('admin.courses.assign-users', [
            'course'   => $course,
            'students' => $students,
        ]);
    }

    public function assign(Request $request, Course $course)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);

        $course->students()->syncWithoutDetaching([
            $request->user_id => ['enrollment_date' => now()],
        ]);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Estudiante asignado',
            'text'  => 'El estudiante fue agregado al curso.',
            'timer' => 3000
        ]);

        return back();
    }
}
