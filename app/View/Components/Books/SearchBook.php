<?php

namespace App\View\Components\Books;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchBook extends Component
{
    /**
     * Create a new component instance.
     */

    public $action;
    public $placeholder;
    public function __construct($action, $placeholder='ابحث من هنا ')
    {
        $this->action = $action;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.books.search-book');
    }
}
