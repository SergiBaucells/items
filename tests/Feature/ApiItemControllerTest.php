<?php

namespace Tests\Feature;

use Baucells\Items\Models\Item;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ApiItemControllerTest.
 *
 * @package Tests\Feature
 */
class ApiItemControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Set up tests.
     */
    public function setUp()
    {
        parent::setUp();
//        $this->withoutExceptionHandling();
    }

    /**
     * Can list items.
     *
     * @test
     */
    public function can_list_items()
    {
        $items = factory(Item::class,3)->create();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->json('GET', '/api/v1/items');

        $response->assertSuccessful();

        $response->assertJsonStructure([[
          'id',
          'name',
          'created_at',
          'updated_at'
        ]]);
    }

    /**
     * Can show an item.
     *
     * @test
     */
    public function can_show_an_item()
    {
        $item = factory(Item::class)->create();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->json('GET', '/api/v1/items/' . $item->id);

        $response->assertSuccessful();

        $response->assertJson([
            'id' => $item->id,
            'name' => $item->name,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at
        ]);
    }

    /**
     * Cannot add item if not logged.
     *
     * @test
     */
    public function cannot_add_item_if_not_logged()
    {
        $faker = Factory::create();

        $response = $this->json('POST', '/api/v1/items', [
            'name' => $name = $faker->word
        ]);

        $response->assertStatus(401);
    }

    /**
     * Cannot add item if no name provided
     *
     * @test
     */
    public function cannot_add_item_if_no_name_provided()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->json('POST', '/api/v1/items');

        $response->assertStatus(422);
    }

    /**
     * Can add an item.
     *
     * @test
     */
    public function can_add_a_item()
    {
        $faker = Factory::create();
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->json('POST', '/api/v1/items', [
            'name' => $name = $faker->word
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('items', [
           'name' => $name
        ]);

        $response->assertJson([
            'name' => $name
        ]);
    }

    /**
     * Can delete an item.
     *
     * @test
     */
    public function can_delete_item()
    {
        $item = factory(Item::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->json('DELETE','/api/v1/items/' . $item->id);

        $response->assertSuccessful();

        $this->assertDatabaseMissing('items',[
           'id' =>  $item->id
        ]);

        $response->assertJson([
            'id' => $item->id,
            'name' => $item->name
        ]);
    }

    /**
     * Cannot delete unexisting item.
     *
     * @test
     */
    public function cannot_delete_unexisting_item()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->json('DELETE','/api/v1/items/1');

        $response->assertStatus(404);
    }

    /**
     * Can edit an item.
     *
     * @test
     */
    public function can_edit_item()
    {
        // PREPARE
        $item = factory(Item::class)->create();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        // EXECUTE
        $response = $this->json('PUT', '/api/v1/items/' . $item->id, [
            'name' => $newName = 'NOU NOM'
        ]);

        // ASSERT
        $response->assertSuccessful();

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'name' => $newName
        ]);

        $this->assertDatabaseMissing('items', [
            'id' => $item->id,
            'name' => $item->name,
        ]);

        $response->assertJson([
            'id' => $item->id,
            'name' => $newName
        ]);
    }

}