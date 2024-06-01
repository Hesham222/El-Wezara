<?php

namespace Organization\Http\Requests\PurchaseOrderPayment;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePurchaseOrderPayment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'purchase_order' => ['required',Rule::exists('purchase_orders','id')->where(function ($query) {
                $query->where('status_id', 4);
            })],
            'payment_type' => 'required|in:cash,credit card,cheque,bank transfer',
            'type' => 'required|in:payment made,payment received',
            'amount' => 'required|numeric|min:0.01|max:999999999.99',
            'date' => 'required|date|date_format:Y-m-d|before_or_equal:'.Carbon::now()->format('Y-m-d'),
            'reference_number' => 'nullable|string|max:191|regex:/\d+/',
        ];
    }
}
