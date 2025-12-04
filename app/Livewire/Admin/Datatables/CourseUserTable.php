<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CourseUser;
use Illuminate\Database\Eloquent\Builder;

class CourseUserTable extends DataTableComponent
{
    public $courseId;

    protected $model = CourseUser::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return CourseUser::query()
            ->where('course_id', $this->courseId)
            ->with(['user', 'course']);
    }

    public function deleteStudent($id)
    {
        CourseUser::findOrFail($id)->delete();
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),

            Column::make("Curso", "course.title")
                ->sortable()
                ->searchable(),

            Column::make("Estudiante", "user.name")
                ->sortable()
                ->searchable(),

            Column::make("Email", "user.email")
                ->sortable()
                ->searchable(),

            Column::make("Fecha Inscripción", "enrollment_date")
                ->sortable()
                ->format(fn($value) => $value ? $value->format('d/m/Y H:i') : '—'),

            Column::make('Acciones')
                ->label(fn($row) => view('admin.courses.partials.delete-student', ['row' => $row])),
        ];
    }
}
