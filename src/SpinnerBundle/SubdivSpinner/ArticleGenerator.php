<?php

namespace SpinnerBundle\SubdivSpinner;

class ArticleGenerator
{

    /**
     * @var SubdivisionReport
     */
    protected $subdivisionReport;

    public function generate()
    {

    }

    /**
     * @return SubdivisionReport
     */
    public function getSubdivisionReport()
    {
        return $this->subdivisionReport;
    }

    /**
     * @param SubdivisionReport $subdivisionReport
     * @return ArticleGenerator
     */
    public function setSubdivisionReport($subdivisionReport)
    {
        $this->subdivisionReport = $subdivisionReport;

        return $this;
    }


}