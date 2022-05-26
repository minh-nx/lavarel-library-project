<?php

namespace App\Observers;

use App\Models\Borrow;

class BorrowObserver
{
    /**
     * Handle the Borrow "created" event.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return void
     */
    public function created(Borrow $borrow)
    {
        //
    }

    /**
     * Handle the Borrow "updated" event.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return void
     */
    public function updated(Borrow $borrow)
    {
        //
    }

    /**
     * Handle the Borrow "deleted" event.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return void
     */
    public function deleted(Borrow $borrow)
    {
        //
    }

    /**
     * Handle the Borrow "restored" event.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return void
     */
    public function restored(Borrow $borrow)
    {
        //
    }

    /**
     * Handle the Borrow "force deleted" event.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return void
     */
    public function forceDeleted(Borrow $borrow)
    {
        //
    }
}
