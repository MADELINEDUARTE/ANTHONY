<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

/**
 * Class ExerciseController
 * @package App\Http\Controllers
 */
class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exercises = Exercise::paginate();

        return view('exercise.index', compact('exercises'))
            ->with('i', (request()->input('page', 1) - 1) * $exercises->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exercise = new Exercise();
        return view('exercise.create', compact('exercise'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Exercise::$rules);

        $exercise = Exercise::create($request->all());

        return redirect()->route('exercises.index')
            ->with('success', 'Exercise created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exercise = Exercise::find($id);

        return view('exercise.show', compact('exercise'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exercise = Exercise::find($id);

        return view('exercise.edit', compact('exercise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Exercise $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exercise $exercise)
    {
        request()->validate(Exercise::$rules);

        $exercise->update($request->all());

        return redirect()->route('exercises.index')
            ->with('success', 'Exercise updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $exercise = Exercise::find($id)->delete();

        return redirect()->route('exercises.index')
            ->with('success', 'Exercise deleted successfully');
    }
}
