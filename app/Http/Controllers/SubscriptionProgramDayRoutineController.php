<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionProgramDayRoutine;
use Illuminate\Http\Request;

/**
 * Class SubscriptionProgramDayRoutineController
 * @package App\Http\Controllers
 */
class SubscriptionProgramDayRoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptionProgramDayRoutines = SubscriptionProgramDayRoutine::paginate();

        return view('subscription-program-day-routine.index', compact('subscriptionProgramDayRoutines'))
            ->with('i', (request()->input('page', 1) - 1) * $subscriptionProgramDayRoutines->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subscriptionProgramDayRoutine = new SubscriptionProgramDayRoutine();
        return view('subscription-program-day-routine.create', compact('subscriptionProgramDayRoutine'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(SubscriptionProgramDayRoutine::$rules);

        $subscriptionProgramDayRoutine = SubscriptionProgramDayRoutine::create($request->all());

        return redirect()->route('subscription-program-day-routines.index')
            ->with('success', 'SubscriptionProgramDayRoutine created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subscriptionProgramDayRoutine = SubscriptionProgramDayRoutine::find($id);

        return view('subscription-program-day-routine.show', compact('subscriptionProgramDayRoutine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subscriptionProgramDayRoutine = SubscriptionProgramDayRoutine::find($id);

        return view('subscription-program-day-routine.edit', compact('subscriptionProgramDayRoutine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SubscriptionProgramDayRoutine $subscriptionProgramDayRoutine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubscriptionProgramDayRoutine $subscriptionProgramDayRoutine)
    {
        request()->validate(SubscriptionProgramDayRoutine::$rules);

        $subscriptionProgramDayRoutine->update($request->all());

        return redirect()->route('subscription-program-day-routines.index')
            ->with('success', 'SubscriptionProgramDayRoutine updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $subscriptionProgramDayRoutine = SubscriptionProgramDayRoutine::find($id)->delete();

        return redirect()->route('subscription-program-day-routines.index')
            ->with('success', 'SubscriptionProgramDayRoutine deleted successfully');
    }
}
