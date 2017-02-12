<?php

namespace AppBundle\Entity;

trait CanHaveMissingDataTrait
{

    /**
     * @return array
     */
    public function getDataPoints()
    {
        $props = get_object_vars($this);

        unset($props['id']);

        return $props;
    }

    /**
     * @return bool
     */
    public function hasMissingData()
    {
        return in_array(null, $this->getDataPoints(), true);
    }

    /**
     * @return bool
     */
    public function isMissingData()
    {
        return $this->hasMissingData();
    }

    /**
     * @return array
     */
    public function getMissingDataFields()
    {
        $fields = array_filter($this->getDataPoints(), function ($dataPoint) {
            return $dataPoint === null;
        });

        return array_keys($fields);
    }

}