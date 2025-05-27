<?php

namespace App\View\Components\Dashboard\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class allBooks extends Component
{
    /**
     * Create a new component instance.
     */
    public $books;
    public function __construct($books)
    {
        $this->books = $books;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.admin.all-books');
    }
}
