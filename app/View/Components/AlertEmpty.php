<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AlertEmpty extends Component
{
    
    public $n;

    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($n, $name)
    {
        $this->n = $n;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert-empty');
    }
}
