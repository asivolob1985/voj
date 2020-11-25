<?php

namespace App;

class TariffService extends BaseModel {

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tariffs() {
        return $this->belongsToMany(Tariff::class);
    }

}
