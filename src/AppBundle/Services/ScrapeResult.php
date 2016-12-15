<?php

namespace AppBundle\Services;

class ScrapeResult
{

    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var array
     */
    protected $errors;

    /**
     * ScrapeResult constructor.
     * @param $fileName
     */
    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return count($this->errors) > 0;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return ScrapeResult
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     * @return ScrapeResult
     */
    public function addError($errors)
    {
        $this->errors[] = $errors;

        return $this;
    }




}