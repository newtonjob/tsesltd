<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Notifications\TransactionPaid;
use Illuminate\Support\Facades\Notification;

class TransactionObserver
{
    /**
     * Handle the Transaction "creating" event.
     */
    public function creating(Transaction $transaction): void
    {
        $transaction->reference ??= uniqid('b');
    }

    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        if ($transaction->wasChanged('paid_at')) {
            Notification::send($transaction->notifiables(),
                new TransactionPaid($transaction)
            );
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
    }
}
