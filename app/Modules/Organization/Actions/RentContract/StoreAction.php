<?php
namespace Organization\Actions\RentContract;
use App\Http\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Organization\Models\{
    RentContract
};
use Organization\Models\RentContractPayment;

class StoreAction
{
    public function execute(Request $request)
    {
        $file = FileTrait::storeSingleFile($request->file('attachment'),'RentContracts');

        $endDate = null;
        $paymentDates = [];
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
        $record =  RentContract::create([
            'vendor_id'             => $request->input('tenant'),
            'rent_space_id'         => $request->input('rentSpace'),
            'attachment'            => $file,
            'durationType'          => $request->input('durationType'),
            'duration'              => $request->input('duration'),
            'start_date'            => $request->input('start_date'),
            'end_date'              => $endDate,
            'amount'                => $request->input('amount') * $request->input('duration'),
            'annual_increase'       => $request->input('annualIncrease'),
            'revenue_share'         => $request->input('revenueShare'),
            'paymentType'           => $request->input('paymentType'),
            'notes'                 => $request->input('notes'),
            'created_by'            => auth('organization_admin')->user()->id
        ]);
        for ($i = 0; $i < count($paymentDates); $i++)
        {
            RentContractPayment::create([
                'rent_contract_id' => $record->id,
                'payment_date' => $paymentDates[$i],
                'amount'    => $request->input('amount')
            ]);
        }
        return $record;
    }

    public function isSpaceTaken($request)
    {
        $start_date     = Carbon::parse($request['start_date']);
        $end_date       = Carbon::parse($request['end_date']);
        $rentContracts  = RentContract::where('rent_space_id', $request['rentSpace'])->get();
        if (
            $rentContracts->where('start_date', '>=', $start_date)->where('start_date', '<', $end_date)->count() ||
            $rentContracts->where('start_date', '<', $start_date)->where('end_date', '>', $start_date)->count() ||
            $rentContracts->where('start_date', '<', $end_date)->where('end_date', '>', $end_date)->count()||
            $rentContracts->where('start_date', '<', $start_date)->where('end_date', '>', $end_date)->count()
        )
        {
            return true;
        }
        else{
            return false;
        }
    }
}
