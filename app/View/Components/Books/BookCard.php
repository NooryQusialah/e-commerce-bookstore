<?php

namespace App\View\Components\Books;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BookCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $book;
    public $title;
    public function __construct($book, $title)
    {
        $this->book = $book;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.books.book-card');
    }
}
