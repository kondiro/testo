<?php

namespace App\View\Components\Forms;

use App\classes\FormDataBinder;
use App\View\Component;


class Checkbox extends Component
{
    // all properties extended from component class & used by these component
    //['name','value','label']

    /*
     * this for multi checkbox , server will get array of checkbox checked
     */
    public bool $multi;

    /*
     * in case this component is inside option list , error should be hidden
     */
    public bool $showError;

    public bool $checked;


    /**
     * @param string $name
     * @param string $label
     * @param string|null $value
     * @param bool $checked
     * @param bool $multi
     * @param bool $showError
     * @param bool $required
     * @param bool $readonly
     */
    public function __construct(
        string $name,
        string $label,
        string $value = null,
        bool   $checked = false,
        bool   $multi = false,
        bool   $showError = true,
        bool $required = false,
        bool $readonly = false


    )
    {
        parent::__construct();
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->checked = $checked;
        $this->showError = $showError;
        $this->multi = $multi;
        $this->readonly = $readonly;
        $this->required = $required;


        if (old($name) != null || in_array($name, array_keys(old()))) {
            if ($multi) {
                $this->checked = is_array(old($name)) && count(old($name)) && in_array($value, old($name));
            } else {
                $this->checked = in_array($name, array_keys(old()));
            }
        } elseif ($this->isModelExists() && $this->isModel()) {

            if ($multi) {
                if (is_array($this->model[$this->name]) && count($this->model[$this->name])) {

                    $this->checked = in_array($value, $this->model[$this->name]);
                } else {
                    $this->checked = $value == $this->model[$this->name];
                }
            } else {
                $this->checked = $this->model[$this->name] == $value;
            }
        }

    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.checkbox');
    }
}
