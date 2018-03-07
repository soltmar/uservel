<?php

namespace marsoltys\uservel\Traits;

trait AddsFillable
{
    /**
     * Adds fillable column
     * @param string $value column name
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addFillable($value)
    {
        if (!in_array($value, $this->fillable))
        {
            $this->fillable[] = $value;
        }

        return $this;
    }
}