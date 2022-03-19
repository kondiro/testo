<?php

namespace App\View\Components\Forms;

use App\classes\FormDataBinder;
use Illuminate\Database\Eloquent\Model;


class TextArea extends \App\View\Component
{
    // all properties extended from component class & used by these component
    // ['name','value','label' , 'required' , 'readonly']



    /**
     * @param string $label
     * @param string $name
     * @param bool $required
     * @param bool $readonly
     */
    public function __construct(
        string $label,
        string $name,
        bool   $required = false,
        bool   $readonly = false
    )
    {
        parent::__construct();
        $this->label = $label;
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
        return view('components.forms.text-area');
    }
}
