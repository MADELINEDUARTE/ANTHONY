<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use Illuminate\Http\Request;

/**
 * Class GenderController
 * @package App\Http\Controllers
 */
class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genders = Gender::paginate();

        return view('gender.index', compact('genders'))
            ->with('i', (request()->input('page', 1) - 1) * $genders->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gender = new Gender();
        return view('gender.create', compact('gender'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Gender::$rules);

        $gender = Gender::create($request->all());

        return redirect()->route('genders.index')
            ->with('success', 'Gender created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gender = Gender::find($id);

        return view('gender.show', compact('gender'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gender = Gender::find($id);

        return view('gender.edit', compact('gender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Gender $gender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gender $gender)
    {
        request()->validate(Gender::$rules);

        $gender->update($request->all());

        return redirect()->route('genders.index')
            ->with('success', 'Gender updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $gender = Gender::find($id)->delete();

        return redirect()->route('genders.index')
            ->with('success', 'Gender deleted successfully');
    }
}
