<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class DefaultLayout extends Component
{
    public $title;
    public $selected;
    public $layoutAttributes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $selected = '', $layoutAttributes = null)
    {
        $this->title = $title;
        $this->selected = $selected;
        $this->layoutAttributes = $layoutAttributes;
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
