<?php

namespace SpinnerBundle\SubdivSpinner;

use SpinnerBundle\Spinner\Inflect;
use SpinnerBundle\Spinner\Spinner;

class Words extends Spinner
{

    /**
     * @var Spinner
     */
    protected $spinner;


    public function __construct()
    {
        $this->spinner = new Spinner();
    }

    public function pluralize($sing)
    {
        return Inflect::pluralize($sing);
    }

    public function house()
    {
        return $this->spin([
            'house', 'home', 'unit'
        ]);
    }

    public function houses()
    {
        return $this->pluralize($this->house());
    }

    public function minMax()
    {
        $min = $this->spin([
            'minimum','lowest'
        ]);
        $max = [
            'minimum' => 'maximum',
            'lowest' => 'highest'
        ];
        $max = $max[$min];

        return [
            'max' => $max,
            'min' => $min
        ];
    }

    public function fastest()
    {
        return $this->spin([
            'fastest', 'quickest', 'speediest'
        ]);
    }

    public function size()
    {
        return $this->spin([
            'size', 'square footage', 'area'
        ]);
    }

    public function biggest()
    {
        return $this->spin([
            'biggest', 'largest'
        ]);
    }

    public function price()
    {
        return "price" . $this->freq(' tag', 15);
    }

    public function cheapestPriciest()
    {
        $cheapest = $this->spin([
            'cheapest', 'least expensive', 'lowest priced'
        ]);

        $priciest = [
            'cheapest' => 'priciest',
            'least expensive' => 'most expensive',
            'lowest priced' => 'highest priced'
        ];

        $priciest = $priciest[$cheapest];

        return [
            'cheapest' => $cheapest,
            'priciest' => $priciest
        ];
    }

    public function dom()
    {
        return $this->spin([
            'number of days on market', 'number of days needed to sell', 'number of days until sale'
        ]);
    }

    public function newest()
    {
        return $this->spin([
            'newest', 'most recently built', 'youngest'
        ]);
    }

    public function approximately()
    {
        return $this->spin([
            'approximately', 'nearly', 'roughly', 'about', 'near', 'around',
            'in the ballpark of', 'almost', 'close to', 'loosely'
        ]);
    }

    public function approx()
    {
        return $this->freq($this->approximately(), 20);
    }

    public function was()
    {
        return "{$this->approx()} was";
    }

    public function freq($str, $perc)
    {
        $r = rand(0,100);

        if ($r < $perc ) {
            return $str;
        } else {
            return "";
        }
    }

    public function spin(array $arr)
    {
        return $this->spinner->spinArray($arr);
    }

}