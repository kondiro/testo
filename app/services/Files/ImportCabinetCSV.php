<?php

namespace App\services\Files;

use App\Models\Avocat;
use App\Models\Barreaux;
use App\Models\Bureau;
use App\Models\Ville;
use App\services\Security\Validation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use function redirect;
use function validator;


class ImportCabinetCSV
{

    public const AVOCAT = 0;
    public const BUREAU = 1;
    private $boothTable;
    /*
     * all avocats + bureau database columns
     */
    private static $allKeys;
    /*
     * only required key avocats + bureau database columns
     */
    private static $requiredKey;
    /*
     *  avocats  database columns
     */
    private static $avocatKeys;

    private static $avocatRequiredKeys;
    /*
     *   bureau database columns
     */
    private static $bureauKeys;
    private static $bureauRequiredKeys;


    ///////////////////////////

    /*
     * file path
     */
    private $csvFile;
    /*
     * csv data as array
     */
    private $csvData;
    /*
     * csv only keys
     */
    private $headers;
    /*
     * the records saved to database
     */
    private $dataAdded;

    /**
     * @return mixed
     */
    public function getDataAdded()
    {
        return $this->dataAdded;
    }

    public function __construct($file, $bout_table = true)
    {
        $this->csvFile = $file;
        $this->boothTable = $bout_table;

        $this->init();
    }


    private function init()
    {
        self::$bureauRequiredKeys = [
            'bureau_nomAr',
            'bureau_nom'
        ];
        self::$avocatRequiredKeys = [
            'avocat_idAv',
            'avocat_cin',
            'avocat_nomAvAr',
            'avocat_nomAv',
            'avocat_prenomAvAr',
            'avocat_prenomAv',
            'avocat_barreauFk'
        ];

        self::$avocatKeys = [
            'avocat_idAv',
            'avocat_cin',
            'avocat_nomAvAr',
            'avocat_nomAv',
            'avocat_prenomAvAr',
            'avocat_prenomAv',
            'avocat_adresseAr',
            'avocat_adresse',
            'avocat_ville',
            'avocat_Fixe',
            'avocat_Fax',
            'avocat_gsm',
            'avocat_email',
            'avocat_siteWeb',
            'avocat_diplomeTitreAR',
            'avocat_diplomeTitre',
            'avocat_descriptionAr',
            'avocat_description',
            'avocat_bureauFk',
            'avocat_barreauFk',
            'avocat_profil',
            'avocat_logo',
            'avocat_etatAvocat',
        ];
        self::$bureauKeys = [
            'bureau_nomAr',
            'bureau_nom',
            'bureau_adresseAr',
            'bureau_adresse',
            'bureau_ville',
            'bureau_Fixe',
            'bureau_Fax',
            'bureau_gsm',
            'bureau_email',
            'bureau_siteWeb',
            'bureau_descriptionAr',
            'bureau_description',
            'bureau_logo',
            'bureau_etatBureau'
        ];
        if ($this->boothTable === self::BUREAU) {
            self::$bureauKeys[] = 'president';
        }
        self::$requiredKey = array_merge(self::$bureauKeys, self::$avocatRequiredKeys);
        self::$allKeys = array_merge(self::$avocatKeys, self::$bureauKeys);
    }

    public function make()
    {
        $parser = (new CSVParser($this->csvFile))->setCsv();
        if ($parser !== false) {
            $this->csvData = $parser->getData();
            $this->headers = $parser->getHeaders();
            \File::delete($this->csvFile);

            //  3 - check if file is empty
            return $this->start();
        } else {
            // not readable file
            return redirect()
                ->with(['fails', [3, true]]);
        }
    }


    public function start()
    {
        if ($this->check()) {
            $required_key = $this->checkRequired();

            if (is_array($required_key)) {
                return [
                    // 0 => require key
                    'fails' => [0, $required_key]
                ];
            }

            $validator = $this->validate();
            if (is_array($validator)) {
                // 1 => validation
                return ['fails' => [1, $validator]];
            }
            $this->removeUnUsedKey();
            $this->store();
        } else {
            // 2 => empty or some key is not exists
            return [
                'fails' => [2, true]
            ];
        }
    }


    public function check(): bool
    {
        return is_array($this->csvData) && count($this->csvData);
    }


    public function checkRequired()
    {
        $not_in_array = [];
        $required = match ($this->boothTable) {
            self::BUREAU => self::$bureauRequiredKeys,
            self::AVOCAT => self::$avocatRequiredKeys,
            true => self::$requiredKey,
        };
        foreach ($required as $key) {
            if (!in_array($key, $this->headers)) {
                $not_in_array[] = $key;
            }
        }


        return count($not_in_array) ? $not_in_array : false;
    }


    public function validate()
    {
        $i = 0;
        $rules = match ($this->boothTable) {
            self::BUREAU => $this->bureauRules(),
            self::AVOCAT => $this->avocatRules(),
            true => array_merge($this->bureauRules(), $this->avocatRules()),
        };

        foreach ($this->csvData as $item) {
            ++$i;
            $validator = validator($item, $rules);

            if ($validator->fails()) {
                return [
                    'position' => $i,
                    'errors' => $validator->errors()->toArray(),
                ];
            }
        }
        return true;

    }


    public function store()
    {
        foreach ($this->csvData as $row) {
            // create elequant instance

            if ($this->boothTable === true) {

                $bureau = new Bureau();
                $avocat = new Avocat();
                $this->fillBureauModel($bureau, $row);
                $this->fillAvocatsModel($avocat, $row);
                $bureau['president'] = $avocat[Avocat::PRIMARY_KEY];
                $avocat['bureauFk'] = $bureau[Bureau::PRIMARY_KEY];
                $avocat->save();
                $bureau->save();
            } else {
                if ($this->boothTable === self::AVOCAT) {
                    $avocat = new Avocat();
                    $this->fillAvocatsModel($avocat, $row);
                    $avocat->save();
                } else {
                    $bureau = new Bureau();
                    $this->fillBureauModel($bureau, $row);
                    $bureau->save();
                }
            }

            $this->exportAddedData($avocat ?? null, $bureau ?? null);
        }
    }


    private function removeUnUsedKey()
    {
        foreach ($this->headers as $key) {
            if (!in_array($key, self::$allKeys)) {
                unset($this->headers[$key]);
            }
        }
    }

    private function fillAvocatsModel(Model $model, $data)
    {
        foreach (self::$avocatKeys as $item) {
            $key = trim(str_replace('avocat_', '', $item));
            $model[$key] = empty($data[$item]) ? null : $data[$item];
        }
    }

    private function fillBureauModel(Model $model, $data)
    {
        foreach (self::$bureauKeys as $item) {
            $key = trim(str_replace('bureau_', '', $item));
            $model[$key] = empty($data[$item]) ? null : $data[$item];
        }
    }

    private function exportAddedData($avocat_model = null, $bureau_model = null)
    {

        $row = [];
        if (isset($avocat_model)) {
            $avocat = [];
            foreach (self::$avocatKeys as $key) {
                $show_key = trim(str_replace('avocat_', '', $key));
                $avocat[$key] = $avocat_model[$show_key];
            }
            $row = array_merge($row, $avocat);
        }
        if (isset($bureau_model)) {
            $bureau = [];
            foreach (self::$bureauKeys as $key) {
                $show_key = trim(str_replace('bureau_', '', $key));
                $bureau[$key] = $bureau_model[$show_key];
            }
            $row = array_merge($row, $bureau);
        }

        $this->dataAdded[] = $row;
    }


    public function avocatRules(): array
    {
        return [
            'avocat_idAv' => 'required|string|max:20|unique:avocats,' . Avocat::PRIMARY_KEY,
            'avocat_cin' => 'required|string|max:10|unique:avocats,cin',
            'avocat_nomAvAr' => 'required|string|max:50',
            'avocat_nomAv' => 'required|string|max:50',
            'avocat_prenomAvAr' => 'required|string|max:50',
            'avocat_prenomAv' => 'required|string|max:50',
            'avocat_adresseAr' => 'nullable|string|max:255',
            'avocat_adresse' => 'nullable|string|max:255',
            'avocat_ville' => 'nullable|string|max:15',
            'avocat_Fixe' => 'nullable|string|max:15',
            'avocat_Fax' => 'nullable|string|max:15',
            "avocat_gsm" => "nullable|min:9|max:15|regex:" . Validation::PHONE_NUMBER_REGEX,
            'avocat_email' => 'nullable|email|max:150',
            'avocat_siteWeb' => 'nullable|url|max:150',
            'avocat_diplomeTitreAR' => 'nullable|string|max:150',
            'avocat_diplomeTitre' => 'nullable|string|max:150',
            'avocat_descriptionAr' => 'nullable|string|max:255',
            'avocat_description' => 'nullable|string|max:255',
            'avocat_bureauFk' => 'nullable|exists:bureaux,' . Bureau::PRIMARY_KEY,
            'avocat_barreauFk' => 'required|exists:barreaux,' . Barreaux::PRIMARY_KEY,
            'avocat_profil' => 'nullable|string|max:255',
            'avocat_logo' => 'nullable|string|max:255',
            'etatAvocat' => 'nullable|string|', Rule::in(['PI', 'ABN', 'I' , 'ABNE' , 'B'])

        ];
    }

    public function bureauRules(): array
    {
        $rules = [
            'bureau_nomAr' => 'required|string|max:150',
            'bureau_nom' => 'required|string|max:50',
            'bureau_adresseAr' => 'nullable|string|max:255',
            'bureau_adresse' => 'nullable|string|max:255',
            'bureau_ville' => 'nullable|exists:villes,' . Ville::PRIMARY_KEY,
            'bureau_Fixe' => 'nullable|string|max:50',
            'bureau_Fax' => 'nullable|string|max:50',
            "bureau_gsm" => "nullable|min:9|max:15|regex:" . Validation::PHONE_NUMBER_REGEX,
            'bureau_email' => 'nullable|email|max:150',
            'bureau_siteWeb' => 'nullable|url|max:150',
            'bureau_descriptionAr' => 'nullable|string|max:255',
            'bureau_description' => 'nullable|string|max:255',
            'bureau_logo' => 'nullable|string|max:250',
            'president' => 'required|exists:avocats,' . Avocat::PRIMARY_KEY,
            'etatBureau' => 'nullable|string|', Rule::in(['PI','I', 'ABN', 'ABNE', 'B'])

        ];

        if ($this->boothTable) {
            unset($rules['president']);
        }
        return $rules;

    }

}
