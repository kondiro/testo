<?php

namespace App\View\Components\Forms;

use App\classes\FormDataBinder;
use App\View\Component;
use Illuminate\Database\Eloquent\Model;


class Input extends Component
{
    // all properties extended from component class & used by these component
    // ['name','value','label' , 'required' , 'readonly' , 'type']

    /**
     * @param $label
     * @param string $type
     * @param $name
     * @param bool $required
     * @param bool $readonly
     */
    public function __construct(
        $label,
        $name,
        bool $required = false,
        bool $readonly = false,
        string $type = 'text'
    )
    {
        parent::__construct();
        $this->label = $label;
        $this->type = $type;
        $this->name = $name;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->getValue();
    }





    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.input');
    }
}
