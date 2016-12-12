<?php namespace AppBundle\PdfScraper\Stat;


class AbstractDataPointParser
{

    /**
     * @var string the text at the beginning of the parsed row
     */
    protected $columnTitle;
    
    public function parse($row) 
    {
        $row = $this->clean($row);
        
        $data = explode(" ", $row);

        return $this->makeOutput($data);
    }

    /**
     * Takes the raw cleaned data array and
     * returns an array with the keys as the CityReport fields
     * mapped to their values
     *
     * @param array $data
     * @return array
     */
    abstract public function makeOutput(array $data);

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

        $str = str_replace("+", " +", $str);
        $str = str_replace("+ ", "+", $str);
        $str = str_replace("  +", "+", $str);
        $str = str_replace(" +", "+", $str);
        
        return $str;
    }

    /**
     * @param string $str
     * @return string
     */
    protected function removeSpecialChars($str)
    {
        $str = str_replace("$", "", $str);
        $str = str_replace("%", "", $str);
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