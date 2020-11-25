<?php

namespace App;

class Slider extends BaseModel {

    /**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed                                 $type
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type = 'on_main') {

        return $query->where('active', 1)->where('type', $type);
    }
}