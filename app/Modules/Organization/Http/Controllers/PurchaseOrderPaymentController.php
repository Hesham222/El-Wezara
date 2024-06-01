<?php

namespace Organization\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Organization\Http\Requests\PurchaseOrderPayment\{StorePurchaseOrderPayment};

use Organization\Models\{PurchaseOrder, PurchaseOrderPayment, RentContract};


class PurchaseOrderPaymentController extends JsonResponse
{

    public function index(Request $request)
    {
        if ($request->filled('made'))
            $purchaseOrderPayments = PurchaseOrderPayment::with(['purchaseOrder', 'admin'])->when($request->input('made'), function ($query) {
                return $query->where('type', 'payment made');
            }, function ($query) {
                return $query->where('type', 'payment received');
            })->get();
        else
            $purchaseOrderPayments = PurchaseOrderPayment::with(['purchaseOrder', 'admin'])->get();
        return view('Organization::purchaseOrderPayments.index', compact(  'purchaseOrderPayments'));
    }

    //return view of create new purchaseOrderPayment
    public function create()
    {
        $po = PurchaseOrder::find(request()->input('po'));
        $orders = PurchaseOrder::where('status_id', 4)->get();
        return view('Organization::purchaseOrderPayments.create', compact(  'orders','po'));
    }

    //store purchaseOrderPayment data
    public function store(StorePurchaseOrderPayment $request)
    {
        DB::beginTransaction();
        try {
            $po = PurchaseOrder::findOrFail($request->input('purchase_order'));
            if ($request->input('type') == 'payment made') {
                if (($po->remaining - $request->input('amount')) < 0)
                    return redirect()->back()->withInput()->with(['error' => 'قد تجاوزت المبلغ المتبقي']);
                $po->remaining -= $request->input('amount');
                $po->save();
            } else {
                if (($po->to_return - $request->input('amount')) < 0)
                    return redirect()->back()->withInput()->with(['error' => 'قد تجاوزت المبلغ الإجمالي']);
                $po->to_return -= $request->input('amount');
                $po->save();
            }
            PurchaseOrderPayment::create([
                'purchase_order_id' => $request->input('purchase_order'),
                'amount' => $request->input('amount'),
                'type' => $request->input('type'),
                'payment_type' => $request->input('payment_type'),
                'reference_number' => $request->input('reference_number'),
                'date' => $request->input('date'),
                'admin_id' => auth('organization_admin')->user()->id,
            ]);
            DB::commit();
            session()->flash('_added','م إنشاء دفع طلب الشراء بنجاح');
            return redirect()->route('organizations.purchaseOrderPayment.index');
        } catch (\Exception $exception) {
            DB::rollback();
            abort(500);
        }
    }

    public function show($id)
    {
        abort(404);
    }

    //return view of purchaseOrderPayment edit page
    public function edit($id)
    {
        abort(404);
        $po = PurchaseOrderPayment::with(['purchaseOrder', 'admin'])->findOrFail($id);
        $MainTitle = __('Account::purchaseOrderPayments.purchaseOrderPayments');
        $SubTitle = __('Account::actions.edit');
        $orders = PurchaseOrder::where('status_id', 4)->get();
        return view('Account::purchaseOrderPayments.edit', compact('po', 'MainTitle', 'SubTitle', 'orders'));
    }

    //update purchaseOrderPayment data
    public function update(StorePurchaseOrderPayment $request, $id)
    {
        abort(404);
        DB::beginTransaction();
        try {

            $purchaseOrderPayment = PurchaseOrderPayment::with(['purchaseOrder'])->findOrFail($id);
            $oldPo = $purchaseOrderPayment->purchaseOrder;
            if ($purchaseOrderPayment->type == 'payment made') {
//                if (($oldPo->remaining + $purchaseOrderPayment->amount) > $oldPo->total)
//                    return redirect()->back()->withInput()->with(['error' => __('Account:purchaseOrderPayments.oldexceedt')]);
                $oldPo->remaining += $purchaseOrderPayment->amount;
                $oldPo->save();
            } else {

//                if (($oldPo->to_return + $request->input('amount')) < 0)
//                    return redirect()->back()->withInput()->with(['error' => __('Account::purchaseOrderPayments.oldexceed0')]);
                $oldPo->to_return += $purchaseOrderPayment->amount;
                $oldPo->save();
            }

            $po = PurchaseOrder::findOrFail($request->input('purchase_order'));

            if ($request->input('type') == 'payment made') {
                if (($po->remaining - $request->input('amount')) < 0)
                    return redirect()->back()->withInput()->with(['error' => __('Account::purchaseOrderPayments.exceed0')]);
                $po->remaining -= $request->input('amount');
                $po->save();
            } else {
                if (($po->to_return - $request->input('amount')) < 0)
                    return redirect()->back()->withInput()->with(['error' => __('Account::purchaseOrderPayments.exceedt')]);
                $po->to_return -= $request->input('amount');
                $po->save();
            }

            $purchaseOrderPayment->update([
                'purchase_order_id' => $request->input('purchase_order'),
                'amount' => $request->input('amount'),
                'type' => $request->input('type'),
                'payment_type' => $request->input('payment_type'),
                'reference_number' => $request->input('reference_number'),
                'date' => $request->input('date'),
            ]);
            $purchaseOrderPayment->save();
            DB::commit();
            session()->flash('_updated', __('Account::purchaseOrderPayments.messages.updated'));
            return redirect()->route('accounts.purchaseOrderPayment.index');
        } catch (\Exception $exception) {
            DB::rollback();
            abort(500);
        }
    }

}
