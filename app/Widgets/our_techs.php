<?php

namespace App\Widgets;

use App\Tech;
use Arrilot\Widgets\AbstractWidget;

class our_techs extends AbstractWidget {

    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run() {
        return view('widgets.our_techs', [
            'config'     => $this->config,
            'advantages' => Tech::all(),
        ]);
    }

    /**
     * The number of minutes before cache expires.
     * False means no caching at all.
     *
     * @var int|float|bool
     */
    public $cacheTime = 3600;
}
