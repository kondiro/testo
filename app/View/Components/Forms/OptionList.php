<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class OptionList extends Component
{
    /*
     * to show the error , came from server
     */
    public string $name;
    /*
     * option list title
     */
    public string $label;
    /*
     * validate option
    */
    public bool $required;
    /*
     * minimum of selection
     */
    public int $min;


    /**
     * @param $label
     * @param int $min
     * @param string $name
     * @param bool $required
     * @param bool $multi
     */
    public function __construct($label, int $min = 0, string $name = "", bool $required = false)
    {
        $this->required = $required;
        $this->name = $name;
        $this->label = $label;
        $this->min = $min;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.option-list');
    }
}
