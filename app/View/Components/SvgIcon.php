<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SvgIcon extends Component
{
    public $name;
    public $class;

    public function __construct($name, $class = '')
    {
        $this->name = $name;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.svg-icon', [
            'name' => $this->name,
            'class' => $this->class,
        ]);
    }
}
