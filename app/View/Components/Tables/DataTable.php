<?php

namespace App\View\Components\Tables;


use App\classes\Helpers;
use App\View\Component;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use function GuzzleHttp\Psr7\str;

class DataTable extends Component
{
    // all properties extended from component class & used by these component
    // ['collection']


    // datatable title
    public string $title;
    // datatable columns
    public array $datatableColumns;
    // button edit route
    public string $editRoute;

    // button delete route
    public string $deleteRoute;

    // more routes
    public array $moreRoutes;

    // primary key of models inside collection
    public string $primaryKey;
    public string $storagePath;

    private $id;

    public $dataCollection;


    /**
     * @param string $title
     * @param array $datatableColumns
     * @param string $editRoute
     * @param string $deleteRoute
     * @param string $primaryKey
     * @param string $id
     * @param string $storagePath
     */
    public function __construct(
        string $title = '',
        array  $datatableColumns = [],
        array  $moreRoutes = [],
        string $editRoute = '',
        string $deleteRoute = '',
        string $primaryKey = '',
        string $id = '',
        string $storagePath = '/neptune/rtl/storage/app/'

    )
    {
        parent::__construct();

        $this->id = $id;
        $this->dataCollection = $this->collection ?? null;

        $this->title = $title;
        $this->datatableColumns = $datatableColumns;
        $this->editRoute = $editRoute;
        $this->deleteRoute = $deleteRoute;
        $this->primaryKey = $primaryKey;
        $this->storagePath = $storagePath;
        $this->moreRoutes = $moreRoutes;
    }


    /**
     * this function will generate full path for delete or update
     * the idea beyond get_class  is to get model primary key if  we don't provide @pk variable
     * @param $route
     * @param $model
     * @return string
     * @throws Exception
     */
    public function generateActionUrlIfNoPk($route, $model): string
    {
        return route($route, Helpers::getModelPrimaryKey($model));
    }


    public function getPrimaryKey($model): string
    {
        return Helpers::getModelPrimaryKey($model);
    }


    /*
       * generate id
       */
    public function id(): string
    {
        if (!empty($this->id)) {
            return $this->id;
        }

        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, \Str::length($characters) - 1)];
        }
        return $this->id = $randomString;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tables.data-table');
    }
}
