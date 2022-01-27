<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Status;
use App\Models\Subscription;
use Illuminate\Http\Request;

/**
 * Class SubscriptionController
 * @package App\Http\Controllers
 */
class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::paginate();

        return view('subscription.index', compact('subscriptions'))
            ->with('i', (request()->input('page', 1) - 1) * $subscriptions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subscription = new Subscription();
        $statuses = Status::all();
        $packages = Package::all();
        return view('subscription.create', compact('subscription','statuses','packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Subscription::$rules);

        $subscription = Subscription::create($request->all());

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subscription = Subscription::find($id);
        $statuses = Status::all();
        $packages = Package::all();
        return view('subscription.show', compact('subscription','statuses','packages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subscription = Subscription::find($id);
        $statuses = Status::all();
        $packages = Package::all();
        return view('subscription.edit', compact('subscription','statuses','packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Subscription $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        request()->validate(Subscription::$rules);

        $subscription->update($request->all());

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $subscription = Subscription::find($id)->delete();

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription deleted successfully');
    }
}
