<?php

namespace App\Http\Controllers;

use App\Models\FrequentlyAskedQuestion;
use Illuminate\Http\Request;

/**
 * Class FrequentlyAskedQuestionController
 * @package App\Http\Controllers
 */
class FrequentlyAskedQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frequentlyAskedQuestions = FrequentlyAskedQuestion::paginate();

        return view('frequently-asked-question.index', compact('frequentlyAskedQuestions'))
            ->with('i', (request()->input('page', 1) - 1) * $frequentlyAskedQuestions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $frequentlyAskedQuestion = new FrequentlyAskedQuestion();
        return view('frequently-asked-question.create', compact('frequentlyAskedQuestion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(FrequentlyAskedQuestion::$rules);

        $frequentlyAskedQuestion = FrequentlyAskedQuestion::create($request->all());

        return redirect()->route('frequently-asked-questions.index')
            ->with('success', 'FrequentlyAskedQuestion created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $frequentlyAskedQuestion = FrequentlyAskedQuestion::find($id);

        return view('frequently-asked-question.show', compact('frequentlyAskedQuestion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $frequentlyAskedQuestion = FrequentlyAskedQuestion::find($id);

        return view('frequently-asked-question.edit', compact('frequentlyAskedQuestion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  FrequentlyAskedQuestion $frequentlyAskedQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FrequentlyAskedQuestion $frequentlyAskedQuestion)
    {
        request()->validate(FrequentlyAskedQuestion::$rules);

        $frequentlyAskedQuestion->update($request->all());

        return redirect()->route('frequently-asked-questions.index')
            ->with('success', 'FrequentlyAskedQuestion updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $frequentlyAskedQuestion = FrequentlyAskedQuestion::find($id)->delete();

        return redirect()->route('frequently-asked-questions.index')
            ->with('success', 'FrequentlyAskedQuestion deleted successfully');
    }
}
