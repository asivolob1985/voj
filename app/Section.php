<?php

namespace App;

class Section extends BaseModel {

    public static function getAllSections(){

        return static::select(['alias', 'name'])->get();
    }
}
