<?php

namespace App\Http\Controllers;

use App\Models\RoutineLog;
use Illuminate\Http\Request;

/**
 * Class RoutineLogController
 * @package App\Http\Controllers
 */
class RoutineLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routineLogs = RoutineLog::paginate();

        return view('routine-log.index', compact('routineLogs'))
            ->with('i', (request()->input('page', 1) - 1) * $routineLogs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routineLog = new RoutineLog();
        return view('routine-log.create', compact('routineLog'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(RoutineLog::$rules);

        $routineLog = RoutineLog::create($request->all());

        return redirect()->route('routine-logs.index')
            ->with('success', 'RoutineLog created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $routineLog = RoutineLog::find($id);

        return view('routine-log.show', compact('routineLog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $routineLog = RoutineLog::find($id);

        return view('routine-log.edit', compact('routineLog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  RoutineLog $routineLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoutineLog $routineLog)
    {
        request()->validate(RoutineLog::$rules);

        $routineLog->update($request->all());

        return redirect()->route('routine-logs.index')
            ->with('success', 'RoutineLog updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $routineLog = RoutineLog::find($id)->delete();

        return redirect()->route('routine-logs.index')
            ->with('success', 'RoutineLog deleted successfully');
    }
}
