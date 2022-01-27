<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\ProgramDay;
use Illuminate\Http\Request;

/**
 * Class ProgramDayController
 * @package App\Http\Controllers
 */
class ProgramDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programDays = ProgramDay::paginate();

        return view('program-day.index', compact('programDays'))
            ->with('i', (request()->input('page', 1) - 1) * $programDays->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programDay = new ProgramDay();
        $programs = Program::all();
        return view('program-day.create', compact('programDay','programs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ProgramDay::$rules);

        $programDay = ProgramDay::create($request->all());

        return redirect()->route('program-days.index')
            ->with('success', 'ProgramDay created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programDay = ProgramDay::find($id);

        return view('program-day.show', compact('programDay'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programDay = ProgramDay::find($id);
        $programs = Program::all();
        return view('program-day.edit', compact('programDay','programs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProgramDay $programDay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramDay $programDay)
    {
        request()->validate(ProgramDay::$rules);

        $programDay->update($request->all());

        return redirect()->route('program-days.index')
            ->with('success', 'ProgramDay updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $programDay = ProgramDay::find($id)->delete();

        return redirect()->route('program-days.index')
            ->with('success', 'ProgramDay deleted successfully');
    }
}
