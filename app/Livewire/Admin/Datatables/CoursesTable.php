<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Course;


class CoursesTable extends DataTableComponent
{
    protected $model = Course::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        // Ordenar por ID descendente para ver los últimos creados primero
        // $this->setDefaultSort('id', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->sortable(),

            Column::make("Título", "title")
                ->sortable()
                ->searchable(),

            //columna de descripcon corta
            Column::make("Descripción", "description")
                ->format(
                    fn($value) => strlen($value) > 50 ? substr($value, 0, 50) . '...' : $value
                )
                ->searchable(), 


            Column::make("Precio", "price")
                ->sortable()
                ->format(
                    fn($value) => '$' . number_format($value, 2)
                ),

            Column::make("Duración", "duration_minutes")
                ->sortable()
                ->format(
                    fn($value) => $value ? $value . ' min' : 'N/A'
                ),

            Column::make("Estado", "published")
                ->sortable()
                ->format(
                    fn($value, $row, $column) => $row->published 
                        ? '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Publicado</span>' 
                        : '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Borrador</span>'
                )
                ->html(),

            Column::make("Acciones", "id")
                ->label(
                    fn($row, $column) => view('admin.courses.actions', ['course' => $row])
                ),
        ];
    }
}