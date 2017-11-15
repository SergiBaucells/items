<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class CreateItemCommandTest.
 *
 * @package Tests\Feature
 */
class CreateItemCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_new_item()
    {
        $this->artisan('item:create', ['name' => 'Pool party','description' => 'with cool girls']);

        $resultAsText = Artisan::output();

        $this->assertDatabaseHas('items', [
           'name' => 'Pool party',
           'description' => 'with cool girls',
        ]);

        $this->assertContains('Item has been added to database succesfully', $resultAsText);

    }

    public function testItAsksForAItemNameAndThenCreatesNewItem()
    {
        $command = Mockery::mock('Baucells\Items\Console\Commands\CreateItemCommand[ask]');

        $command->shouldReceive('ask')
            ->once()
            ->with('Item name?')
            ->andReturn('Pool party');

        $command->shouldReceive('ask')
            ->once()
            ->with('Item description?')
            ->andReturn('with cool girls');

        $this->app['Illuminate\Contracts\Console\Kernel']->registerCommand($command);

        $this->artisan('item:create');

        $this->assertDatabaseHas('items', [
            'name' => 'Pool party',
            'description' => 'with cool girls',
        ]);

        $resultAsText = Artisan::output();
        $this->assertContains('Item has been added to database succesfully', $resultAsText);
    }


}
