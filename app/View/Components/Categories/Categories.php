<?php

namespace App\View\Components\Categories;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Categories extends Component
{
    /**
     * Create a new component instance.
     */

    public $categories;
    public function __construct($categories)
    {
        $this->categories = $categories;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.categories.categories');
    }
}
