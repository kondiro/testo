<?php

namespace App\View;

use App\classes\FormDataBinder;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component as BladeComponent;

class Component extends BladeComponent
{

    // component title
    public $label;
    // component value
    public $value;

    // component type (for inputs)
    public $type;

    // component name
    public $name;

    // component validation
    public $required;


    public $readonly;


    // component id
    private $id;

    /*
     *  model (bind)
     *  model witch will binded with the component
    */
    protected $model;

    //  collection of models witch will binded with the component
    protected $collection;


    public function __construct()
    {
        if (FormDataBinder::isCollection()) {
            $this->collection = FormDataBinder::get();
            $this->except[] = 'model';
        } else {
            $this->model = FormDataBinder::get();
            $this->except[] = 'collection';
        }
    }

    public function render()
    {
        // TODO: Implement render() method.
    }

    /*
         * get the status of model prop
         */
    public function isModelExists(): bool
    {
        return isset($this->model);
    }

    /*
     * get the status of model prop
     */
    public function isModel(): bool
    {
        return $this->model instanceof Model;
    }


    /*
     * check if current component has old value or model value
     * its works just with components which has value attr
     */
    protected function getValue(): void
    {
        // if exist old and model is same time
        // priority for old because old run just time if exists

        if (old($this->name) !== null && $this->isModelExists() ) {
            $this->value = old($this->name);
        } else {
            if ($this->isModelExists() && $this->isModel()) {
                $this->value = $this->model[$this->name] ?? '';
            } else if (old($this->name) !== null) {
                $this->value = old($this->name) ?? '';
            } else {

                $this->value = "";
            }
        }

    }

    /*
     * generate id
     */
    public function id(): string
    {
        if (!empty($this->id)) {
            return $this->id;
        }
        return $this->id = \Str::random(10);
    }

}
