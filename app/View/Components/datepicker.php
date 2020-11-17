<?php

namespace App\View\Components;

use Illuminate\View\Component;

class datepicker extends Component
{
    public $id;
    public $var;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $var)
    {
        $this->id = $id;
        $this->var = $var;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.datepicker');
    }
}
