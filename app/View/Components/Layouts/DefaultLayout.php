<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class DefaultLayout extends Component
{
    public $title;
    public $selected;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $selected = '')
    {
        $this->title = $title;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.default-layout');
    }
}
