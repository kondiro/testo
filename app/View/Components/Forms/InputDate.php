<?php

namespace App\View\Components\Forms;

use App\classes\FormDataBinder;
use App\View\Component;

class InputDate extends Component
{
    // all properties extended from component class & used by these component
    // ['name','value','label' , 'required' , 'readonly' ]

    public $pickerType;

    /**
     * @param $label
     * @param $name
     * @param bool $required
     * @param bool $readonly
     * @param string $pickerType
     */
    public function __construct(
        $label,
        $name,
        bool $required = false,
        bool $readonly = false,
        string $pickerType = 'd'
    )
    {
        parent::__construct();
        $this->model = FormDataBinder::get();
        $this->label = $label;
        $this->name = $name;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->pickerType = $pickerType;
        $this->getValue();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input-date');
    }
}
