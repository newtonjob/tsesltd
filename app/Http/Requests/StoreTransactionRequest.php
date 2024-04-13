<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'amount'    => 'required|integer',
            'channel'   => Rule::can('create', Transaction::class),
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->mergeIfMissing([
            'amount' => $this->order->amountPayable()
        ]);
    }

    /**
     * Fulfill the request.
     */
    public function fulfill(): Transaction
    {
        return $this->order->transactions()->pending()->updateOrCreate(
            ['amount' => $this->amount, 'created_by' => $this->user()->id],
            $this->only('channel')
        )->tap($this->markTransactionAsPaidIfCashOrTransfer(...));
    }

    /**
     * Mark the transaction as paid, only if it is a 'cash' transaction.
     */
    public function markTransactionAsPaidIfCashOrTransfer(Transaction $transaction): void
    {
        if ($transaction->isCash() || $transaction->isTransfer()) {
            $transaction->markAsPaid();
        }
    }
}
