<?php

namespace App\Http\Controllers;

use App\Models\ProgramDayRoutine;
use Illuminate\Http\Request;

/**
 * Class ProgramDayRoutineController
 * @package App\Http\Controllers
 */
class ProgramDayRoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programDayRoutines = ProgramDayRoutine::paginate();

        return view('program-day-routine.index', compact('programDayRoutines'))
            ->with('i', (request()->input('page', 1) - 1) * $programDayRoutines->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programDayRoutine = new ProgramDayRoutine();
        return view('program-day-routine.create', compact('programDayRoutine'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ProgramDayRoutine::$rules);

        $programDayRoutine = ProgramDayRoutine::create($request->all());

        return redirect()->route('program-day-routines.index')
            ->with('success', 'ProgramDayRoutine created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programDayRoutine = ProgramDayRoutine::find($id);

        return view('program-day-routine.show', compact('programDayRoutine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programDayRoutine = ProgramDayRoutine::find($id);

        return view('program-day-routine.edit', compact('programDayRoutine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProgramDayRoutine $programDayRoutine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramDayRoutine $programDayRoutine)
    {
        request()->validate(ProgramDayRoutine::$rules);

        $programDayRoutine->update($request->all());

        return redirect()->route('program-day-routines.index')
            ->with('success', 'ProgramDayRoutine updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $programDayRoutine = ProgramDayRoutine::find($id)->delete();

        return redirect()->route('program-day-routines.index')
            ->with('success', 'ProgramDayRoutine deleted successfully');
    }
}
