<?php

namespace Baucells\Items\Http\Controllers;

use Baucells\Items\Models\Item;
use Illuminate\Http\Request;
use Redirect;
use Session;

/**
 * Class ItemsController.
 *
 * @package Acacha\Items\Http\Controllers
 */
class ItemsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('items::list_items',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items::create_item');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Item::create($request->only(['name','description']));

        Session::flash('status', 'Created ok!');

        return Redirect::to('/items_php/create');

    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Item $item)
    {
        return view('items::show_item',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Item $item
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Item $item)
    {
        return view('items::edit_item',['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Item $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Item $item)
    {
        $item->update($request->only(['name','description']));

        Session::flash('status', 'Edited ok!');
        return Redirect::to('/items_php/edit/' . $item->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Item $item)
    {
        $item->delete();
        Session::flash('status', 'Item was deleted successful!');
        return Redirect::to('/items_php');
    }
}
