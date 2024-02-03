<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        return response()->json($payments);
    }

    function approvePayment(Request $request,$id) {

        $payment = Payment::find($id);
        $user = User::find($payment->userid);
        $nidbalance = $user->nidbalance;
        $amount = $payment->amount;
        $re_nidbalance = $amount/25;

        if($request->action=='cancel'){
            if($payment->status=='approved'){
                $newnidbalance = $nidbalance-$re_nidbalance;
                $user->update(['nidbalance'=>$newnidbalance]);
            }
            $payment->update(['status'=>'Canceled']);
            return $user;

        }

        $newnidbalance = $nidbalance+$re_nidbalance;
        $user->update(['nidbalance'=>$newnidbalance]);

        $payment->update(['status'=>'approved']);
        return $user;
    }


    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'userid' => 'required|exists:users,id',
            // 'trxid' => 'required',
            'amount' => 'required|numeric',
            // 'vat' => 'required|numeric',
            // 'total_amount' => 'required|numeric',
            // 'mobile_no' => 'required',
            'payment_wallet' => 'required',
            'method' => 'required',
            'mer_trxid' => 'required',
            // 'date' => 'required|date',
            // 'status' => 'required',
            // 'month' => 'required|integer',
            // 'year' => 'required|integer',
            // 'payment_type' => 'required',
            // 'ipn' => 'required',
            // 'payment_url' => 'required',
            // 'old_nid_balance' => 'required|numeric',
        ]);


        $validatedData['trxid'] = date('Y').time();
        $validatedData['date'] = date('Y-m-d');
        $validatedData['status'] = 'Pending';
        $validatedData['month'] = date('m');
        $validatedData['year'] = date('Y');
        $validatedData['payment_type'] = 'menual';
        $amount = $request->amount;
        $nid_balance = $amount/25;
        $validatedData['nid_balance'] = $nid_balance;






        // Create a new Payment instance
        $payment = Payment::create($validatedData);

        return response()->json($payment, 201);
    }

    // Display the specified resource.
    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        return response()->json($payment);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'userid' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            // 'vat' => 'required|numeric',
            // 'total_amount' => 'required|numeric',
            // 'mobile_no' => 'required',
            'payment_wallet' => 'required',
            'method' => 'required',
            'mer_trxid' => 'required',
            // 'date' => 'required|date',
            // 'status' => 'required',
            // 'month' => 'required|integer',
            // 'year' => 'required|integer',
            // 'payment_type' => 'required',
            // 'ipn' => 'required',
            // 'payment_url' => 'required',
            // 'old_nid_balance' => 'required|numeric',
        ]);


        $validatedData['trxid'] = date('Y').time();
        $validatedData['date'] = date('Y-m-d');
        $validatedData['status'] = 'Pending';
        $validatedData['month'] = date('m');
        $validatedData['year'] = date('Y');
        $validatedData['payment_type'] = 'menual';



        // Find the Payment record and update it
        $payment = Payment::findOrFail($id);
        $payment->update($validatedData);

        return response()->json($payment, 200);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        // Find the Payment record and delete it
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response()->json(null, 204);
    }


    public function paymentsForUser($userId)
    {
        $user = User::findOrFail($userId);

        $payments = Payment::where('userid', $userId)
            ->with('user')
            ->orderBy('id','desc')
            ->paginate(20); // Adjust the pagination size as needed

        return response()->json($payments);
    }
}
