<?php

namespace App\services\Files;

/*
 * convert csv files to php array
 * csv file parser
 */

use App\services\Arrays;

class CSVParser
{
    protected $csv;
    protected $data = array();
    protected $headers = array();
    protected $limit = 0;
    protected $delimiter = ',';
    protected $valid_delimiters = array(',', ';', "\t", '|', ':');


    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }


    protected $valid_mime_types = array(
        'text/csv',
        'text/plain',
        'application/csv',
        'text/comma-separated-values',
        'application/excel',
        'application/vnd.ms-excel',
        'application/vnd.msexcel',
    );

    public function __construct($csv, $delimiter = null)
    {
        if (isset($delimiter)) {
            $this->delimiter = $delimiter;
        }
        $this->csv = $csv;
    }


    public function setCsv()
    {
        if (!empty($this->csv)) {

            // Set the File to be Parsed
            $is_valid_file = $this->checkFile($this->csv);

            // Set the Delimeter
            $is_valid_delimiter = $this->setDelimiter();


            if (!$is_valid_delimiter || !$is_valid_file) {
                return false;
            }

            // trigger the parsing
            $this->parse();
        }

        return $this;

    }


    private function checkFile($csv = null): bool
    {
        // set the file to be checked
        $file = ($csv === null) ? $this->csv : $csv;

        // verify if parameter meets the contract
        if (
            empty($file) ||
            !file_exists($file) ||
            !is_object($file) && !in_array(mime_content_type($file), $this->valid_mime_types)
        ) {
            return false;
        }

        $this->csv = $csv;

        return true;
    }

    /*
     * check if delimiter is valid
     */
    private function setDelimiter(): bool
    {
        // verify if parameter meets the contract
        if (in_array($this->delimiter, $this->valid_delimiters)) {
            return true;
        }
        return false;
    }


    /*
  * convert csv file to array (key/val)
  */
    private function parse()
    {
        if (!file_exists($this->csv) || !is_readable($this->csv))
            return false;
        $header = null;
        $data = array();
        if (($handle = fopen($this->csv, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $this->delimiter)) !== false) {
                if (!isset($header)) {
                    $header = Arrays::trimArray($row);
                } else {
                    if (is_array($row) && is_array($header) && count($row) == count($header)) {
                        $data[] = array_combine($header, $row);
                    }
                }
            }
            fclose($handle);
        }
        $this->headers = $header;
        $this->data = $data;
    }


}
