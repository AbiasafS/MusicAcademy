@extends('adminlte::page')

@section('content')
<div class="container">

    <h2>Asignar Estudiantes a: {{ $course->title }}</h2>

    <form action="{{ route('admin.courses.assign-users', $course) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id">Estudiante</label>
            <select name="user_id" class="form-control" required>
                <option value="">Seleccione un estudiante</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Asignar</button>
    </form>

    <hr>

    <h4>Estudiantes Asignados</h4>

    @livewire('admin.datatables.course-user-table', ['courseId' => $course->id])

</div>
@endsection
