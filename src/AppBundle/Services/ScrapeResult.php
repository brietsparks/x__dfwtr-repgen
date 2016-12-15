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
    protected $errors = [];

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
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     *
     * @return ScrapeResult
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
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