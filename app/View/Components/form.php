<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class form extends Component
{
    public $name;
    public $type;

    /**
     * Create a new component instance.
     */
    public function __construct($name,$type)
    {
        $this->name=$name;
        $this->type=$type;
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form');
    }
}
