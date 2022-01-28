<?php

namespace App\Http\Controllers;

use App\Models\ExerciseVideo;
use App\Models\Exercise;
use Illuminate\Http\Request;

/**
 * Class ExerciseVideoController
 * @package App\Http\Controllers
 */
class ExerciseVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exerciseVideos = ExerciseVideo::paginate();

        return view('exercise-video.index', compact('exerciseVideos'))
            ->with('i', (request()->input('page', 1) - 1) * $exerciseVideos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exerciseVideo = new ExerciseVideo();
        $exercises = Exercise::all();
        return view('exercise-video.create', compact('exerciseVideo','exercises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ExerciseVideo::$rules);

        $exerciseVideo = ExerciseVideo::create($request->all());

        return redirect()->route('exercise-videos.index')
            ->with('success', 'ExerciseVideo created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exerciseVideo = ExerciseVideo::find($id);

        return view('exercise-video.show', compact('exerciseVideo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exerciseVideo = ExerciseVideo::find($id);
        $exercises = Exercise::all();

        return view('exercise-video.edit', compact('exerciseVideo','exercises'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ExerciseVideo $exerciseVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExerciseVideo $exerciseVideo)
    {
        request()->validate(ExerciseVideo::$rules);

        $exerciseVideo->update($request->all());

        return redirect()->route('exercise-videos.index')
            ->with('success', 'ExerciseVideo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $exerciseVideo = ExerciseVideo::find($id)->delete();

        return redirect()->route('exercise-videos.index')
            ->with('success', 'ExerciseVideo deleted successfully');
    }
}
