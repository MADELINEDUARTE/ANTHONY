<?php

namespace App\Http\Controllers;

use App\Models\PaymentHistory;
use Illuminate\Http\Request;

/**
 * Class PaymentHistoryController
 * @package App\Http\Controllers
 */
class PaymentHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentHistories = PaymentHistory::paginate();

        return view('payment-history.index', compact('paymentHistories'))
            ->with('i', (request()->input('page', 1) - 1) * $paymentHistories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentHistory = new PaymentHistory();
        return view('payment-history.create', compact('paymentHistory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(PaymentHistory::$rules);

        $paymentHistory = PaymentHistory::create($request->all());

        return redirect()->route('payment-histories.index')
            ->with('success', 'PaymentHistory created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentHistory = PaymentHistory::find($id);

        return view('payment-history.show', compact('paymentHistory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentHistory = PaymentHistory::find($id);

        return view('payment-history.edit', compact('paymentHistory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PaymentHistory $paymentHistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentHistory $paymentHistory)
    {
        request()->validate(PaymentHistory::$rules);

        $paymentHistory->update($request->all());

        return redirect()->route('payment-histories.index')
            ->with('success', 'PaymentHistory updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $paymentHistory = PaymentHistory::find($id)->delete();

        return redirect()->route('payment-histories.index')
            ->with('success', 'PaymentHistory deleted successfully');
    }
}
