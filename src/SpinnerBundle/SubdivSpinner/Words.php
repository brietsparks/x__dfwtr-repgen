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

    public function house()
    {
        return $this->spin([
            'house', 'home', 'unit'
        ]);
    }

    public function houses()
    {
        return Inflect::pluralize($this->house());
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
        return $this->spin([
            'price', 'rate'
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
            'in the ballpark of', 'almost', 'close to', 'loosely'
        ]);
    }

    public function was()
    {
        $r = rand(0,100);

        if ($r < 20 ) {
            return "was {$this->approximately()}";
        } else {
            return "was";
        }
    }

    public function spin(array $arr)
    {
        return $this->spinner->spinArray($arr);
    }

}