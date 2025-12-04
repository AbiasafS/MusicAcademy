<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminLayout extends Component
{
    /**
     * Title para las páginas del admin.
     */
    public $title;

    public function __construct($title = null)
    {
        $this->title = $title;
    }

    /**
     * Renderiza la vista principal del layout admin.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.admin');
    }
}
