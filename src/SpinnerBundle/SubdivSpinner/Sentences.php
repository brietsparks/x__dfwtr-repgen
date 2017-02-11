<?php

namespace SpinnerBundle\SubdivSpinner;

class Sentences extends Words
{

    public function sqftParagraph(SubdivisionReport $report)
    {
        $minSqft = $report->minSqft . " square feet";
        $maxSqft = $report->maxSqft . " square feet";
        $avgSqft = $report->avgSqft . " square feet";

        $house = $this->house();
        $houses = $this->houses();

        $biggest = $this->spin([
            'biggest', 'largest'
        ]);

        $size = $this->spin([
            'size', 'area'
        ]);

        $average = $this->spin([
            "on average, $house sizes {$this->were(false)} {$this->approx(75)} $avgSqft",
            "on average, $houses were {$this->approx(75)} $avgSqft {$this->freq("in $size", 15)}",
            "the average $house size {$this->was()} $avgSqft",
            "$house sizes {$this->were(false)} {$this->approx(75)} $avgSqft on average"
        ]);

        $sentences = [
            "the $size of $biggest $house {$this->was()} $maxSqft,
            the smallest {$this->was()} $minSqft, 
            and the average was $avgSqft.",

            "on average, $houses {$this->were()} $avgSqft. 
            The $biggest {$this->was()} $maxSqft, and the smallest was $minSqft.",

            "$house sizes ranged from $minSqft to $maxSqft square feet, with the average
            being {$this->approximately()} $avgSqft.",

            "$average. The $biggest {$this->was()} $maxSqft, and the smallest was $minSqft.",

            "The $biggest {$this->was()} $maxSqft, and the smallest was $minSqft. $average.",
        ];

        
        return $this->finalize($sentences);
    }

    public function priceParagraph(SubdivisionReport $report)
    {
        $minPrice = "$" . number_format ($report->minPrice);
        $maxPrice = "$" . number_format ($report->maxPrice);
        $avgPrice = "$" . number_format ($report->avgPrice);

        $house = $this->house();
        $houses = $this->houses();

        $cheapestPriciest = $this->contrastingPair([
            'cheapest' => 'most expensive',
            'least expensive' => 'most expensive',
            'lowest priced' => 'highest priced'
        ]);

        $price = "price" . $this->freq(' tag', 10);

        $average = $this->spin([
            "on average, $house prices {$this->were(false)} {$this->approx(75)} $avgPrice",
            "on average, $houses sold for {$this->approx(75)} $avgPrice",
            "the average $house price {$this->was()} $avgPrice",
            "$house prices {$this->were(false)} {$this->approx(75)} $avgPrice on average"
        ]);

        $sentences = [
            "The $cheapestPriciest[0] $house {$this->was()} $minPrice,
            the $cheapestPriciest[1] {$this->was()} $maxPrice,
            and the average {$this->was()} $avgPrice.",

            "$house prices ranged from $minPrice on the low end to $maxPrice on the high end. $average.",

            "The $cheapestPriciest[0] $house sold for $minPrice, 
            the $cheapestPriciest[1] sold for $maxPrice,
            and the average $house sold for {$this->approx()} $avgPrice."
        ];

        return $this->finalize($sentences);

    }

    public function pricePerSqftParagraph(SubdivisionReport $report)
    {
        $minPricePerSqft = "$" . $report->minPricePerSqft . " per square foot";
        $maxPricePerSqft = "$" . $report->maxPricePerSqft . " per square foot";
        $avgPricePerSqft = "$" . $report->avgPricePerSqft . " per square foot";

        $house = $this->house();
        $houses = $this->houses();

        $cheapestPriciest = $this->contrastingPair([
            'cheapest' => 'most expensive',
            'least expensive' => 'most expensive',
            'lowest priced' => 'highest priced'
        ]);

        $price = "price" . $this->freq(' tag', 10);

        $average = $this->spin([
            "on average, square footage prices {$this->were(false)} {$this->approx(75)} $avgPricePerSqft",
            "the average square footage price {$this->was()} $avgPricePerSqft",
            "square footage prices {$this->were(false)} {$this->approx(75)} $avgPricePerSqft on average"
        ]);

        $sentences = [
            "The $cheapestPriciest[0] $house by square foot {$this->was()} $minPricePerSqft,
            the $cheapestPriciest[1] {$this->was()} $maxPricePerSqft,
            and the average {$this->was()} $avgPricePerSqft.",

            "$house prices per square foot ranged from $minPricePerSqft on the low end to $maxPricePerSqft on the high end. $average.",

            "In terms of price per square foot, the $cheapestPriciest[0] $house sold for $minPricePerSqft, 
            the $cheapestPriciest[1] sold for $maxPricePerSqft,
            and the average $house sold for {$this->approx()} $avgPricePerSqft."
        ];

        return $this->finalize($sentences);
    }

    public function domParagraph(SubdivisionReport $report)
    {
        $minDom = $report->minDom . " days";
        $maxDom = $report->maxDom . " days";
        $avgDom = $report->avgDom . " days";

        $house = $this->house();
        $houses = $this->houses();

        $dom = $this->spin([
            'number of days on market',
            "number of days for a $house to sell"
        ]);

        $average = $this->spin([
            "on average, a $house sold in $avgDom",
            "the average $dom {$this->was()} $avgDom",
            "it took an average of $avgDom days for a $house to sell"
        ]);

        $sentences = [
            "$average. The most $dom {$this->was()} $maxDom, and the least was $minDom.",
            "The fastest sale took $minDom, and the slowest took $maxDom. The average sale took {$this->approx(75)} $avgDom.",
        ];

        return $this->finalize($sentences);
    }

    public function yearParagraph(SubdivisionReport $report)
    {
        $minYear = $report->minYearBuild;
        $maxYear = $report->maxYearBuild;
        $avgYear = $report->avgYearBuild;

        $house = $this->house();
        $houses = $this->houses();

        $average = $this->spin([
            "On average, $houses were built around $avgYear",
            "The average $house was built around $avgYear"
        ]);

        $sentences = [
            "the newest $house was built in $maxYear and the oldest in $minYear. $average.",
            "$average. the newest $house was built in $maxYear and the oldest in $minYear."
        ];

        return $this->finalize($sentences);
    }
    
    protected function finalize($sentences) 
    {
        $sentences = $this->spin($sentences);

        // remove line breaks
        $sentences = preg_replace( "/\r|\n/", "", $sentences);

        // remove white space
        $sentences = preg_replace('/\s+/', ' ', $sentences);

        $sentences = str_replace('  ', ' ', $sentences);

        $sentences = $this->sentenceCase($sentences);

        return $sentences;
    }

    protected function sentenceCase($string) {
        $string = ucfirst(strtolower($string));

        $string = preg_replace_callback('/[.!?].*?\w/', create_function('$matches', 'return strtoupper($matches[0]);'),$string);

        return $string;
    }

}