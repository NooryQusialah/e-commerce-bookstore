<?php

namespace App\View\Components\Publishers;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PublisherDetails extends Component
{
    /**
     * Create a new component instance.
     */
    public $publishers;
    public function __construct($publishers)
    {
        $this->publishers = $publishers;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.publishers.publisher-details');
    }
}
