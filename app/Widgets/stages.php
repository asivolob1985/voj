<?php

namespace App\Widgets;

use App\Advantage;
use App\Scrum;
use App\Step;
use Arrilot\Widgets\AbstractWidget;

class stages extends AbstractWidget {

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

        return view('widgets.stages', [
            'config' => $this->config,
            'steps' => Step::all(),
            'scrums' => Scrum::all()
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
