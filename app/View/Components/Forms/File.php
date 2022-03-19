<?php

namespace App\View\Components\Forms;

use App\classes\FormDataBinder;
use App\View\Component;
use Illuminate\Database\Eloquent\Model;


class File extends Component
{
    // all properties extended from component class & used by these component
    // ['name','label' , 'required' , 'readonly' , 'value']

    public $filePath;
    public $file_name;
    public $file_ext;
    public $file_type;


    public $orgValue;

    public const IMG = 0;
    public const PDF = 1;
    public const WORD = 2;
    public const EXEL = 3;
    public const DOCS = 4;
    public const ALL = 5;
    public const VIDEO = 6;
    public const AUDIO = 7;
    public const TEXT = 7;


    /**
     * @param $label
     * @param $name
     * @param bool $required
     * @param bool $fileType
     * @param bool $readonly
     * @param string $imgPath
     */
    public function __construct(
        $label,
        $name,
        bool $required = false,
        $fileType = self::IMG,
        bool $readonly = false)
    {
        parent::__construct();
        $this->label = $label;
        $this->name = $name;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->file_type = $fileType;


        $this->getValue();
        $this->getFileInfo();

        $this->orgValue = $this->value;

        if ($this->isModel() && !empty($name) && !str_contains($this->model[$name], 'http')) {
            if (isset($this->model[$name]) && $this->model[$name] != '') {
                $this->value = asset('storage/app/' . $this->value  );
            } else {
                $this->value = null;
            }
        }

    }


    /*
     * get name for input witch contain the path of file chosen
     * after submitting form with chosen file , server will get the file + textbook contain path
     */
    public function generateNameForInputFileTextbook(): string
    {
        return $this->name . '-path';
    }

    public function generateNameForInputFileImgPreview(): string
    {
        return $this->name . '-preview';
    }


    public function getFileInfo()
    {
        if ($this->isModel() && !empty($this->value)) {
            $filePath = storage_path('app/' . $this->value);

            if (file_exists($filePath)) {
                $pathInfo = pathinfo($filePath);
                $this->file_name = $pathInfo['basename'] ?? "";
                $this->file_ext = $pathInfo['extension'] ?? "";
            }
        }
    }


    public function isImage()
    {
        if (isset($this->file_ext)) {
            return in_array($this->file_ext, ['png', 'jpeg', 'jpg']);
        }
        return null;
    }


    public function getType()
    {
        if (substr_count($this->file_type, '|') > 0) {
            return implode(',', array_map(function ($val) {
                return '.' . $val;
            }, explode('|', $this->file_type)));
        }
        return match ($this->file_type) {
            self::IMG => 'image/*',
            self::AUDIO => 'audio/*',
            self::TEXT => 'plain',
            self::VIDEO => 'video/*',
            self::PDF => 'application/pdf',
            self::WORD => 'application/msword',
            self::DOCS => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            self::EXEL => 'application/vnd.ms-excel',
            self::ALL => null,
            default => '.' . $this->file_type
        };

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.file');
    }
}
