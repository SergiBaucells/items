<?php

namespace Tests\Feature;

use Baucells\Items\Models\Item;
use App\User;
use Illuminate\Support\Facades\View;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ItemsTest.
 *
 * @package Tests\Feature
 */
class ItemsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Set up.
     */
    public function setUp()
    {
        parent::setUp();
//        $this->withoutExceptionHandling();
    }

    /**
     * List all items.
     *
     * @test
     */
    public function can_list_items()
    {
        $items = factory(Item::class,3)->create();

        $user = factory(User::class)->create();
        View::share('user',$user);
        $this->actingAs($user);

        $response = $this->get('/items_php');

        $response->assertStatus(200);
        $response->assertSuccessful();
        $response->assertViewIs('items::list_items');
        $items = Item::all();
        $response->assertViewHas('items',$items);

        foreach ($items as $item) {
            $response->assertSeeText($item->name);
            $response->assertSeeText($item->description);
        }
    }

    /**
     * Test show and item.
     *
     * @test
     */
    public function can_show_an_item()
    {
        $item = factory(Item::class)->create();
        $user = factory(User::class)->create();
        View::share('user',$user);
        $this->actingAs($user);

        $response = $this->get('/items_php/' . $item->id);

        $response->assertStatus(200);
        $response->assertSuccessful();
        $response->assertViewIs('items::show_item');
        $response->assertViewHas('item');

        $response->assertSeeText('Item:');
        $response->assertSeeText($item->name);
        $response->assertSeeText($item->description);

    }

    /**
     * Test show and item.
     *
     * @test
     */
    public function cannot_show_an_item()
    {
        $user = factory(User::class)->create();
        View::share('user',$user);
        $this->actingAs($user);

        $response = $this->get('/items_php/9999999');

        $response->assertStatus(404);

    }

    /**
     * Show create item form.
     *
     * @test
     */
    public function show_create_item_form()
    {
        $user = factory(User::class)->create();
        View::share('user',$user);
        $this->actingAs($user);

        $response = $this->get('/items_php/create');

        $response->assertStatus(200);
        $response->assertViewIs('items::create_item');
        $response->assertSeeText('Create Item');
    }

    /**
     * Show edit item form.
     *
     * @test
     */
    public function show_edit_item_form()
    {
        $user = factory(User::class)->create();
        View::share('user',$user);
        $this->actingAs($user);

        $item = factory(Item::class)->create();

        $response = $this->get('/items_php/edit/' . $item->id);
        $response->assertStatus(200);
        $response->assertViewIs('items::edit_item');
        $response->assertSeeText('Edit Item');

        $response->assertSee($item->name);
        $response->assertSee($item->description);
    }

    /**
     * Test store item.
     * @test
     */
    public function store_item()
    {
        $user = factory(User::class)->create();
        View::share('user',$user);
        $this->actingAs($user);

        $item = factory(Item::class)->make();

        $response = $this->post('/items_php',[
            'name' => $item->name,
            'description' => $item->description,
        ]);

        $this->assertDatabaseHas('items',[
            'name' => $item->name,
            'description' => $item->description,
        ]);

        $response->assertRedirect('items_php/create');

    }

    /**
     * Update item.
     *
     * @test
     */
    public function update_item()
    {
        $user = factory(User::class)->create();
        View::share('user',$user);
        $this->actingAs($user);

        $item = factory(Item::class)->create();

        $newItem = factory(Item::class)->make();
        $response = $this->put('/items_php/' . $item->id,[
            'name' => $newItem->name,
            'description' => $newItem->description,
        ]);

        $this->assertDatabaseHas('items',[
            'id' =>  $item->id,
            'name' => $newItem->name,
            'description' => $newItem->description,
        ]);

        $this->assertDatabaseMissing('items',[
            'id' =>  $item->id,
            'name' => $item->name,
            'description' => $item->description,
        ]);

        $response->assertRedirect('items_php/edit/' . $item->id);
    }

    /**
     * Delete item.
     *
     * @test
     */
    public function delete_item()
    {
        $user = factory(User::class)->create();
        View::share('user',$user);
        $this->actingAs($user);

        $item = factory(Item::class)->create();

        $response = $this->delete('/items_php/' . $item->id);

        $this->assertDatabaseMissing('items',[
            'name' => $item->name,
            'description' => $item->description,
        ]);

        $response->assertRedirect('items_php');

    }
}
