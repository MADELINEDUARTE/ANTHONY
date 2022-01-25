<?php

namespace App\Http\Controllers;

use App\Models\ProgramCategory;
use Illuminate\Http\Request;

/**
 * Class ProgramCategoryController
 * @package App\Http\Controllers
 */
class ProgramCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programCategories = ProgramCategory::paginate();

        return view('program-category.index', compact('programCategories'))
            ->with('i', (request()->input('page', 1) - 1) * $programCategories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programCategory = new ProgramCategory();
        return view('program-category.create', compact('programCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ProgramCategory::$rules);

        $programCategory = ProgramCategory::create($request->all());

        return redirect()->route('program-categories.index')
            ->with('success', 'ProgramCategory created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programCategory = ProgramCategory::find($id);

        return view('program-category.show', compact('programCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programCategory = ProgramCategory::find($id);

        return view('program-category.edit', compact('programCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProgramCategory $programCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramCategory $programCategory)
    {
        request()->validate(ProgramCategory::$rules);

        $programCategory->update($request->all());

        return redirect()->route('program-categories.index')
            ->with('success', 'ProgramCategory updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $programCategory = ProgramCategory::find($id)->delete();

        return redirect()->route('program-categories.index')
            ->with('success', 'ProgramCategory deleted successfully');
    }
}
