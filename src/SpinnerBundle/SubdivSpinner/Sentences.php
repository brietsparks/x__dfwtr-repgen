<?php

namespace SpinnerBundle\SubdivSpinner;

class Sentences extends Words
{

    public function sqft(SubdivisionReport $report)
    {
        $minMax = $this->minMax();

        $minSqft = $report->minSqft;
        $small = $this->spin([
            "the {$minMax['min']} {$this->house()} {$this->size()} {$this->was()} $minSqft square feet",
            "the smallest {$this->house()} {$this->was()} $minSqft square feet",
            "the {$this->size()} of the smallest {$this->house()} {$this->was()} $minSqft square feet",
        ]);

        $maxSqft = $report->maxSqft;
        $big = $this->spin([
            "the {$minMax['max']} {$this->house()} {$this->size()} {$this->was()} $maxSqft square feet",
            "the {$this->biggest()} {$this->house()} {$this->was()} $maxSqft square feet",
            "the {$this->size()} of the {$this->biggest()} {$this->house()} {$this->was()} $maxSqft square feet",
        ]);

        $this->spin([
            "$small {$this->joint()} $big.",
            "$big {$this->joint()} $small"
        ]);
    }



    public function joint()
    {
        return $this->spin([
            ", and ", ". "
        ]);
    }

}