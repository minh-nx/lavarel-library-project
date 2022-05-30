<?php

namespace App\Observers;

use App\Models\Borrow;
use App\Models\BorrowsHistory;

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
        BorrowsHistory::create($borrow->getAttributes());
    }

    /**
     * Handle the Borrow "updated" event.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return void
     */
    public function updated(Borrow $borrow)
    {
        $originalData = $borrow->getOriginal();
        $newData = $borrow->getChanges();

        $history = BorrowsHistory::where($this->makeWhereArray($originalData))
                                 ->first();

        $history->update($borrow->getChanges());

        // Auto-delete feature of borrows table when a book associating borrow record is changed from not returned to returned
        // The original value of 'returned_date' should be NULL and the new value should not be NULL
        if(array_key_exists('returned_date', $newData) && is_null($originalData['returned_date']) && !is_null($newData['returned_date'])) {
            // Only then, proceed to automatically delete the record
            $borrow->delete();
        }
    }

    /**
     * Handle the Borrow "deleting" event.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return void
     */
    public function deleting(Borrow $borrow)
    {
        $borrow = Borrow::where('user_id', $borrow->user_id)
                        ->where('book_id', $borrow->book_id)
                        ->first();
            
        $history = BorrowsHistory::where($this->makeWhereArray($borrow->getAttributes()))
                                 ->first();

        // Only attempt to delete the history record if the borrow request has not been deleted as the result of the auto-delete feature of borrows table
        // In which case, the value of 'returned_date' should be NULL
        if(is_null($borrow->getAttribute('returned_date'))) {
            $history->delete();
        }
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

    /**
     * Helper function to get a Borrow model's attributes and convert them to an array for a where query
     *
     * @param  array $borrow
     * @return array
     */
    private function makeWhereArray(array $attributes)
    {
        $arr = array();

        foreach($attributes as $key => $value) {
            $arr[] = array($key, $value);
        }

        return $arr;
    }
}
