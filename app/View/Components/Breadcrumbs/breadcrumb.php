<?php

namespace App\View\Components\Breadcrumbs;

use Illuminate\View\Component;

class breadcrumb extends Component
{


    public $breadCrumb;
    public $links;

    /**
     * @param array $breadCrumb
     * @param array $links
     */
    public function __construct(array $breadCrumb = [], array $links = [])
    {
        $this->breadCrumb = $breadCrumb;
        $this->links = $links;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumbs.breadcrumb');
    }
}
