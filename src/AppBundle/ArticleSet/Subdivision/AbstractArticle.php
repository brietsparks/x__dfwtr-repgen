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
        $title = $this->spinner->getTitle($report);
        $body = $this->spinner->spin($report);
        $footer = $this->getFooter($report);

        $article = (
            $title . "\r\n" . "\r\n" .
            "<p>" . $body . "</p>" . "\r\n" .
            $footer
        );

        return $article;
    }

    abstract function getFooter(SubdivisionReport $report);

    protected function getLcSubdivName($subName)
    {
        $lcCityName = strtolower($subName);
        $lcCityName = str_replace(" ", "-", $lcCityName);

        return $lcCityName;
    }


}