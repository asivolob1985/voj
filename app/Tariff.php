<?php

namespace App;

class Tariff extends BaseModel {

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function main_services() {

        return $this->belongsToMany(TariffService::class, 'tariff_services_main');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dop_services() {

        return $this->belongsToMany(TariffService::class, 'tariff_services_dop');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cost_services() {

        return $this->belongsToMany(TariffService::class, 'tariffs_services_cost');
    }

}
