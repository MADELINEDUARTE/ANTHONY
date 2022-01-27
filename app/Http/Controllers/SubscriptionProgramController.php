<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramDay;
use App\Models\Status;
use App\Models\Subscription;
use App\Models\SubscriptionProgram;
use Illuminate\Http\Request;

/**
 * Class SubscriptionProgramController
 * @package App\Http\Controllers
 */
class SubscriptionProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptionPrograms = SubscriptionProgram::paginate();

        return view('subscription-program.index', compact('subscriptionPrograms'))
            ->with('i', (request()->input('page', 1) - 1) * $subscriptionPrograms->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subscriptionProgram = new SubscriptionProgram();
        $statuses = Status::all();
        $programs = Program::all();
        $subscriptions = Subscription::all();
        
        return view('subscription-program.create', compact('subscriptionProgram','statuses','programs','subscriptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(SubscriptionProgram::$rules);

        $subscriptionProgram = SubscriptionProgram::create($request->all());

        return redirect()->route('subscription-programs.index')
            ->with('success', 'SubscriptionProgram created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subscriptionProgram = SubscriptionProgram::find($id);

        return view('subscription-program.show', compact('subscriptionProgram'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subscriptionProgram = SubscriptionProgram::find($id);
        $statuses = Status::all();
        $programs = Program::all();
        $subscriptions = Subscription::all();
        return view('subscription-program.edit', compact('subscriptionProgram','statuses','programs','subscriptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  SubscriptionProgram $subscriptionProgram
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubscriptionProgram $subscriptionProgram)
    {
        request()->validate(SubscriptionProgram::$rules);

        $subscriptionProgram->update($request->all());

        return redirect()->route('subscription-programs.index')
            ->with('success', 'SubscriptionProgram updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $subscriptionProgram = SubscriptionProgram::find($id)->delete();

        return redirect()->route('subscription-programs.index')
            ->with('success', 'SubscriptionProgram deleted successfully');
    }
}
