<?php

namespace App\Widgets;

use App\Work;
use Arrilot\Widgets\AbstractWidget;

class how_it_works extends AbstractWidget
{
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
    public function run()
    {
        //

        return view('widgets.how_it_works', [
            'config' => $this->config,
            'works' => Work::all()
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
