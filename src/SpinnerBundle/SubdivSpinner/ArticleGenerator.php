<?php

namespace SpinnerBundle\SubdivSpinner;

class ArticleGenerator
{

    /**
     * @var Sentences
     */
    protected $sentences;

    public function __construct()
    {
        $this->sentences = new Sentences();
    }

    public function generate(SubdivisionReport $sr)
    {
        $sentences = $this->sentences;

        $article = [
            $sentences->sqftParagraph($sr),
            $sentences->priceParagraph($sr),
            $sentences->pricePerSqftParagraph($sr),
            $sentences->domParagraph($sr),
            $sentences->yearParagraph($sr)
        ];

        shuffle($article);

        return implode(' ', $article);

    }

}