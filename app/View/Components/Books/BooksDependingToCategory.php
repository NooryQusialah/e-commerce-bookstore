<?php

namespace App\View\Components\Books;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BooksDependingToCategory extends Component
{
    /**
     * Create a new component instance.
     */
    public $books;
    public $title;
    public function __construct($books, $title)
    {
        $this->books = $books;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.books.books-depending-to-category');
    }
}
