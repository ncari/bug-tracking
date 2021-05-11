<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DangerZone extends Component
{

    public $formUrl;

    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $formUrl)
    {
        $this->name = $name;
        $this->formUrl = $formUrl;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.danger-zone');
    }
}
