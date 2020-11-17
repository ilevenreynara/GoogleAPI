<?php

namespace App\View\Components;

use Illuminate\View\Component;

class modal extends Component
{
    public $title;
    public $width;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $width)
    {
        $this->title = $title;
        $this->width = $width;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
