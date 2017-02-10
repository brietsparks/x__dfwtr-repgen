<?php namespace AppBundle\ArticleSet\Subdivision;


use AppBundle\Entity\SubdivisionReport;
use SpinnerBundle\SubdivSpinner\ArticleGenerator;

abstract class AbstractArticle
{

    /**
     * @var ArticleGenerator
     */
    protected $spinner;

    /**
     * AbstractArticle constructor.
     * @param ArticleGenerator $spinner
     */
    public function __construct(ArticleGenerator $spinner)
    {
        $this->spinner = $spinner;
    }

    public function generate(SubdivisionReport $report)
    {
//        $title = $this->getTitle
        $body = $this->spinner->spin($report);
//        $footer = $this->getFooter();

        return $body;
    }

//    abstract function getFooter();


}