<?php
namespace Organization\Actions\RentContract;
use App\Http\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\{
    RentContract
};
use Organization\Models\RentContractPayment;

class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record     = RentContract::find($id);
        $attachment = $record->attachment;

        if($request->file('attachment'))
        {
            FileTrait::RemoveSingleFile($attachment);
            $attachment = FileTrait::storeSingleFile($request->file('attachment'), 'RentContracts');
        }

        $endDate = $record->end_date;
        $paymentDates = [];
        if ($request->input('durationType') != $record->durationType || $request->input('duration') != $record->duration
        || $request->input('start_date') != $record->start_date)
        {
            switch ($request->input('durationType'))
            {
                case 'Annually':
                    $endDate =  Carbon::parse($request->input('start_date'))->addYears($request->input('duration'));
                    array_push($paymentDates,$request->input('start_date'));
                    for ($i = 1; $i < $request->input('duration'); $i++)
                    {
                        $date = Carbon::parse($request->input('start_date'))->addYears($i);
                        array_push($paymentDates,$date);
                    }
                    break;
                case 'Monthly':
                    $endDate = Carbon::parse($request->input('start_date'))->addMonths($request->input('duration'));
                    array_push($paymentDates,$request->input('start_date'));
                    for ($i = 1; $i < $request->input('duration'); $i++)
                    {
                        $date = Carbon::parse($request->input('start_date'))->addMonths($i);
                        array_push($paymentDates,$date);
                    }
                    break;
                case 'Weekly':
                    $endDate = Carbon::parse($request->input('start_date'))->addWeeks($request->input('duration'));
                    array_push($paymentDates,$request->input('start_date'));
                    for ($i = 1; $i < $request->input('duration'); $i++)
                    {
                        $date = Carbon::parse($request->input('start_date'))->addWeeks($i);
                        array_push($paymentDates,$date);
                    }
                    break;
                case 'Daily':
                    $endDate = Carbon::parse($request->input('start_date'))->addDays($request->input('duration')-1);
                    array_push($paymentDates,$request->input('start_date'));
                    for ($i = 1; $i < $request->input('duration'); $i++)
                    {
                        $date = Carbon::parse($request->input('start_date'))->addDays($i);
                        array_push($paymentDates,$date);
                    }
                    break;
            }
        }
        $record->vendor_id      = $request->input('tenant');
        $record->rent_space_id   = $request->input('rentSpace');
        $record->durationType    = $request->input('durationType');
        $record->duration        = $request->input('duration');
        $record->start_date      = $request->input('start_date');
        $record->end_date        = $endDate;
        $record->amount          = $request->input('amount') * $request->input('duration');
        $record->annual_increase = $request->input('annualIncrease');
        $record->revenue_share   = $request->input('revenueShare');
        $record->paymentType     = $request->input('paymentType');
        $record->notes           = $request->input('notes');
        $record->attachment      = $attachment;
        $record->save();
        if (count($paymentDates) > 0)
        {
            RentContractPayment::where([ ['rent_contract_id',$record->id],['status',0] ])->delete();
            for ($i = 0; $i < count($paymentDates); $i++)
            {
                RentContractPayment::create([
                    'rent_contract_id' => $record->id,
                    'payment_date' => $paymentDates[$i],
                    'amount'    => $request->input('amount')
                ]);
            }
        }
        return $record;
    }
}
