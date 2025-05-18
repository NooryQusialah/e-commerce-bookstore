<?php

namespace App\View\Components\Authors;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AuthorsDetails extends Component
{
    /**
     * Create a new component instance.
     */

    public $authors;
    public function __construct($authors)
    {
        $this->authors = $authors;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.authors.authors-details');
    }
}
