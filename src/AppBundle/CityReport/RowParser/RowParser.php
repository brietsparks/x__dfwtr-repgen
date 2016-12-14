<?php

namespace AppBundle\PdfScraper\DataPointParser;

abstract class AbstractDataPointParser
{

    /**
     * @var string the text at the beginning of the parsed row
     */
    protected $columnTitle;

    /**
     * @var string the prefix of the corresponding field in the CityReport entity. Ex: in avgPrice_monthPrev it is avgPrice
     */
    protected $entityFieldPrefix;

    /**
     * Take a text string and return cleaned, parsed data
     *
     * @param string $row
     * @return array
     */
    public function parse($row) 
    {
        $row = $this->clean($row);

        $data = explode(" ", $row);

//        dump(get_class($this));
//        dump($data);
//        exit;

        return $this->makeOutputArray($data);
    }

    /**
     * Takes the raw cleaned data array and
     * returns an array with the keys as the CityReport fields
     * mapped to their values
     *
     * @param array $data
     * @return array
     */
    protected function makeOutputArray(array $data)
    {
        $outputData = [];

        $prefix = $this->entityFieldPrefix;

        if (array_key_exists(0, $data)) {
            $outputData["{$prefix}_monthPrev"] = $data[0];
        }

        if (array_key_exists(1, $data)) {
            $outputData["{$prefix}_monthCurr"] = $data[1];
        }

        if (array_key_exists(2, $data)) {
            $outputData["{$prefix}_monthChange"] = $data[2];
        }

        if (array_key_exists(3, $data)) {
            $outputData["{$prefix}_ytdPrev"] = $data[3];
        }

        if (array_key_exists(4, $data)) {
            $outputData["{$prefix}_ytdCurr"] = $data[4];
        }

        if (array_key_exists(5, $data)) {
            $outputData["{$prefix}_ytdChange"] = $data[5];
        }

        return $outputData;
    }

    /**
     * @param string $row
     * @return string
     */
    protected function clean($row)
    {
        $row = $this->removeNulls($row);
        $row = $this->removeColumnTitle($row);
        $row = $this->correctPosNegSigns($row);
        $row = $this->removeSpecialChars($row);
        $row = $this->removeConsecutiveSpaces($row);
        $row = trim($row);
        
        return $row;
    }


    /**
     * Remove null data (marked as --)
     * 
     * @param string $str
     * @return string
     */
    protected function removeNulls($str) 
    {
        return str_replace("--", "", $str);
    }

    /**
     * @param string $str
     * @return string
     */
    protected function removeColumnTitle($str) 
    {
        return str_replace($this->columnTitle, "", $str);
    }

    /**
     * Correct the spacing around positive (+) and negative (-) signs
     * 
     * @param string $str
     * @return string
     */
    protected function correctPosNegSigns($str)
    {
        $str = str_replace("-", " -", $str);
        $str = str_replace("- ", "-", $str);
        $str = str_replace("  -", "-", $str);
        $str = str_replace(" -", "-", $str);
        $str = str_replace("-", " -", $str);

        $str = str_replace("+", " +", $str);
        $str = str_replace("+ ", "+", $str);
        $str = str_replace("  +", "+", $str);
        $str = str_replace(" +", "+", $str);
        $str = str_replace("+", " +", $str);
        $str = str_replace("+", "", $str);
        
        return $str;
    }

    /**
     * @param string $str
     * @return string
     */
    protected function removeSpecialChars($str)
    {
        // $
        $str = str_replace("$", " $", $str);
        $str = str_replace("$", "", $str);

        // %
        $str = str_replace("%", "% ", $str);
        $str = str_replace("%", "", $str);

        // ,
        $str = str_replace(",", "", $str);

        return $str;
    }

    /**
     * @param string $str
     * @return string
     */
    protected function removeConsecutiveSpaces($str)
    {
        return preg_replace('/\s+/', ' ', $str);
    }
    

}