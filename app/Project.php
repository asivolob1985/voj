<?php

namespace App;

class Project extends BaseModel {

    /**
     * Scope a query to only include users of a given type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed                                 $type
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type = 'all') {
        if ($type === 'main_page') {
            return $query->where('active', 1)->where('on_main', 1);
        }

        return $query->where('active', 1);
    }

    public static function findByAlias($alias) {

        return static::where('alias', $alias, 'and')->active()->with('section')->firstOrFail();
    }

    public function section() {
        return $this->belongsTo('App\Section');
    }

    public static function fields_in_mini() {
        return ['short_name', 'short_desc', 'alias', 'main_image', 'section_id'];
    }

}