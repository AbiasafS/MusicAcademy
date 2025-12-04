<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder; // ⬅️ Añade esta importación


class UserTable extends DataTableComponent
{
    //personalizar las consultas
    // protected $model = User::class;
    
    //Define el modelo y su consulta
    public function builder(): Builder
    {
        return User::query()->with('roles');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            column::make("Numero de id","id")
                ->sortable(),
            Column::make("Rol", "roles")
                ->label(
                    function($row) {
                        return $row->roles->first()?->name ?? 'N/A';
                    }),
             Column::make("actions")
                ->label(function($row){
                    return view('admin.users.actions',
                    ['user' => $row]);
                }),
                
            
          
        ];
    }
}
