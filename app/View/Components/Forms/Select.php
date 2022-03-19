<?php

namespace App\View\Components\Forms;

use App\classes\FormDataBinder;
use App\View\Component;


class Select extends Component
{

// all properties extended from component class & used by these component
    // ['name','value','label' , 'required' , 'readonly' ]




    /**
     * option as assoc array
     */
    public $options;
    /*
     * options as table
     */
    public $table;

    /**
     * @param string $name
     * @param string $label
     * @param null $options
     * @param null $bindWith
     * @param bool $required
     * @param bool $readonly
     */
    public function __construct(string $name, string $label, $options = null, $bindWith = null, bool $required = false, bool $readonly = false)
    {
        parent::__construct();
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->table = $bindWith;


    }


    /*
     * get the model column witch has same components name
     */
    public function column()
    {

        return $this->model[$this->name];
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.select');
    }
}
