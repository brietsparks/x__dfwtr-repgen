<?php

namespace SpinnerBundle\SubdivSpinner;

use SpinnerBundle\Spinner\Inflect;
use SpinnerBundle\Spinner\Spinner;

class Words extends SubdivSpinner
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

    public function contrastingPair(array $arr)
    {
        $key = array_rand($arr);

        return [
            $key, $arr[$key]
        ];
    }

    public function house()
    {
        return $this->spin([
            'house', 'home'
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
            'in the ballpark of', 'almost', 'close to'
        ]);
    }

    public function approx($freq = 20)
    {
        return $this->freq($this->approximately(), $freq);
    }

    public function was($approx = true)
    {
        $approx = $approx ? $this->approx() : '';
        return "was $approx";
    }

    public function were($approx = true)
    {
        $approx = $approx ? $this->approx() : '';
        return "were $approx";
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

}