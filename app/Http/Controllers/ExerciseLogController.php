<?php

namespace App\Http\Controllers;

use App\Models\ExerciseLog;
use Illuminate\Http\Request;

/**
 * Class ExerciseLogController
 * @package App\Http\Controllers
 */
class ExerciseLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exerciseLogs = ExerciseLog::paginate();

        return view('exercise-log.index', compact('exerciseLogs'))
            ->with('i', (request()->input('page', 1) - 1) * $exerciseLogs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exerciseLog = new ExerciseLog();
        return view('exercise-log.create', compact('exerciseLog'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ExerciseLog::$rules);

        $exerciseLog = ExerciseLog::create($request->all());

        return redirect()->route('exercise-logs.index')
            ->with('success', 'ExerciseLog created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exerciseLog = ExerciseLog::find($id);

        return view('exercise-log.show', compact('exerciseLog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exerciseLog = ExerciseLog::find($id);

        return view('exercise-log.edit', compact('exerciseLog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ExerciseLog $exerciseLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExerciseLog $exerciseLog)
    {
        request()->validate(ExerciseLog::$rules);

        $exerciseLog->update($request->all());

        return redirect()->route('exercise-logs.index')
            ->with('success', 'ExerciseLog updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $exerciseLog = ExerciseLog::find($id)->delete();

        return redirect()->route('exercise-logs.index')
            ->with('success', 'ExerciseLog deleted successfully');
    }
}
