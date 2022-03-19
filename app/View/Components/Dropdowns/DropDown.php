<?php

namespace App\View\Components\Dropdowns;

use Illuminate\View\Component;

class DropDown extends Component
{
    /*
    * list of actions as assoc array
    */
    public array $actions;
    /*
     * Dropdown list title
     */
    public string $label;

    /**
     * @param string $label
     * @param array $actions
     */
    public function __construct(string $label = 'Actions', array $actions = [])
    {
        $this->actions = $actions;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.Dropdowns.drop-down');
    }
}
