<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'duration_minutes' => 'nullable|integer|min:0',
            'published' => 'sometimes|boolean',
        ]);

        $data['published'] = $request->has('published');
        Course::create($data);

        return redirect()->route('admin.courses.index')->with('success', 'Curso creado.');
    }

    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'duration_minutes' => 'nullable|integer|min:0',
            'published' => 'sometimes|boolean',
        ]);

        $data['published'] = $request->has('published');
        $course->update($data);

        return redirect()->route('admin.courses.index')->with('success', 'Curso actualizado.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Curso eliminado.');
    }
}
