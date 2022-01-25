<?php

namespace App\Http\Controllers;

use App\Models\UserCard;
use Illuminate\Http\Request;

/**
 * Class UserCardController
 * @package App\Http\Controllers
 */
class UserCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCards = UserCard::paginate();

        return view('user-card.index', compact('userCards'))
            ->with('i', (request()->input('page', 1) - 1) * $userCards->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userCard = new UserCard();
        return view('user-card.create', compact('userCard'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(UserCard::$rules);

        $userCard = UserCard::create($request->all());

        return redirect()->route('user-cards.index')
            ->with('success', 'UserCard created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userCard = UserCard::find($id);

        return view('user-card.show', compact('userCard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userCard = UserCard::find($id);

        return view('user-card.edit', compact('userCard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  UserCard $userCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCard $userCard)
    {
        request()->validate(UserCard::$rules);

        $userCard->update($request->all());

        return redirect()->route('user-cards.index')
            ->with('success', 'UserCard updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $userCard = UserCard::find($id)->delete();

        return redirect()->route('user-cards.index')
            ->with('success', 'UserCard deleted successfully');
    }
}
