<?php
namespace Organization\Actions\Payment;
use Illuminate\Http\Request;
use Organization\Models\Subscription;
use Organization\Models\{
    Payment
};
class BalanceAction
{
    public function execute(Request $request,$record)
    {
        $payment_balance = Subscription::where('id',$record->subscription_id)->select(['payment_balance'])->get();

        foreach ($payment_balance as $pay_balance){
            $balance = $pay_balance->payment_balance;
        }
        $payment_amount = $record->payment_amount;

        if ($payment_amount > $balance){
            return false;
        }else{
            $finalBalance = $balance - $payment_amount;
            return Subscription::where('id',$record->subscription_id)->update([
                'payment_balance' => $finalBalance
            ]);
        }


    }
}
