<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class NavigationMenu extends Component
{
    public $selected;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($selected = '')
    {
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.navigation-menu');
    }

    public function checkSelected($option)
    {
        return (mb_strcasecmp($this->selected, $option) == 0) ? 'style="color: red;"' : '';
    }
}
