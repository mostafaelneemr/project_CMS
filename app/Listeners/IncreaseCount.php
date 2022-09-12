<?php

namespace App\Listeners;

use App\Events\PageViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PageViewer $event)
    {
        $this->updateviewer($event->view);
    }

    function updateviewer($view)
    {
        $view->viewer = $view->viewer+1;
        $view->save();
    }
}

