<?php

namespace App\Widgets;

use App\Advantage;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\App;

class advantages extends AbstractWidget
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
        return view('widgets.advantages', [
            'config' => $this->config,
            'advantages' => Advantage::all(),
        ]);
    }

    /**
     * The number of minutes before cache expires.
     * False means no caching at all.
     *
     * @var int|float|bool
     */
    public $cacheTime = false;
}
