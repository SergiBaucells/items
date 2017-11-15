<?php

namespace Baucells\Items\Http\Controllers;

use Baucells\Items\Http\Requests\DestroyItem;
use Baucells\Items\Http\Requests\ListItems;
use Baucells\Items\Http\Requests\ShowItem;
use Baucells\Items\Http\Requests\StoreItem;
use Baucells\Items\Http\Requests\UpdateItem;
use Baucells\Items\Models\Item;

/**
 * Class APIItemsController.
 * 
 * @package App\Http\Controllers
 */
class APIItemsController extends Controller
{
    /**
     * Show list of items.
     *
     * @param ListItems $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(ListItems $request)
    {
        return Item::all();
    }

    /**
     * Show an item.
     *
     * @param ShowItem $request
     * @param Item $item
     * @return Item
     */
    public function show(ShowItem $request, Item $item)
    {
        return $item;
    }

    /**
     * Store an item.
     *
     * @param StoreItem $request
     * @return mixed
     */
    public function store(StoreItem $request)
    {
        return Item::create($request->only(['name','description']));
    }

    /**
     * Update an item.
     *
     * @param UpdateItem $request
     * @param Item $item
     * @return Item
     */
    public function update(UpdateItem $request , Item $item)
    {
        $item->update($request->only(['name','description']));
        return $item;
    }

    /**
     * Destroy an item.
     *
     * @param DestroyItem $request
     * @param Item $item
     * @return Item
     */
    public function destroy(DestroyItem $request, Item $item)
    {
        $item->delete();
        return $item;
    }

}
