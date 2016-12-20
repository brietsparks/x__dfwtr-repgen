<?php

namespace SpinnerBundle\SubdivSpinner;

class Sentences extends Words
{

    public function sqftParagraph(SubdivisionReport $report)
    {
        $minSqft = $report->minSqft;
        $maxSqft = $report->maxSqft;
        $avgSqft = $report->avgSqft;
        
        $sentences = $this->sentences(
            $minSqft, $maxSqft, $avgSqft,
            'smallest', $this->biggest(),
            $this->size(), 'square feet'
        );

        return $this->finalize($sentences);
    }

    public function priceParagraph(SubdivisionReport $report)
    {
        $minPrice = $report->minPrice;
        $maxPrice = $report->maxPrice;
        $avgPrice = $report->avgPrice;

        $cheapestPriciest = $this->cheapestPriciest();
        $cheapest = $cheapestPriciest['cheapest'];
        $priciest = $cheapestPriciest['priciest'];

        $sentences = $this->sentences(
            $minPrice, $maxPrice, $avgPrice,
            $cheapest, $priciest,
            $this->price(), 'dollars'
        );

        return $this->finalize($sentences);
    }

    public function pricePerSqft(SubdivisionReport $report)
    {
        $minPricePerSqft = $report->minPricePerSqft;
        $maxPricePerSqft = $report->maxPricePerSqft;
        $avgPricePerSqft = $report->avgPricePerSqft;

        $sentences = $this->sentences(
            $minPricePerSqft, $maxPricePerSqft, $avgPricePerSqft,
            'smallest', $this->biggest(),
            $this->size(), 'square feet'
        );

        return $this->finalize($sentences);
    }

    protected function finalize($sentences)
    {
        $min = $sentences['min'];
        $max = $sentences['max'];
        $avg = $sentences['avg'];

        return $this->spin([
            "$min {$this->joint()} $max. $avg",
            "$avg. $min {$this->joint()} $max.",
            "$max {$this->joint()} $min. $avg",
            "$avg. $min {$this->joint()} $max."
        ]);
    }

    protected function sentences(
        $minNum, $maxNum, $avgNum,
        $minAdj, $maxAdj,
        $metric, $uom = null
    ) {
        $minMax = $this->minMax();

        $min = [
            "the {$minMax['min']} {$this->houses()} $metric {$this->was()} $minNum $uom",
            "the $minAdj {$this->houses()} {$this->was()} $minNum $uom",
            "the $metric of the $minAdj {$this->houses()} {$this->was()} $minNum $uom",
        ];

        $max = [
            "the {$minMax['max']} {$this->houses()} $metric {$this->was()} $maxNum $uom",
            "the $maxAdj {$this->houses()} {$this->was()} $maxNum $uom",
            "the $metric of the $maxAdj {$this->houses()} {$this->was()} $maxNum $uom",
        ];

        $avg = [
            "the average {$this->houses()} $metric {$this->was()} $avgNum $uom",
            "the average {$this->houses()} {$this->was()} $avgNum $uom",
            "the $metric of the average {$this->houses()} {$this->was()} $avgNum $uom",
            "{$this->houses()} averaged out to {$this->approx()} $avgNum $uom",
            "on average {$this->houses()} {$this->was()} $avgNum $uom"
        ];

        return [
            'min' => $min,
            'max' => $max,
            'avg' => $avg
        ];
    }



    public function joint()
    {
        return $this->spin([
            ", and ", ". "
        ]);
    }

}