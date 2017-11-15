<?php

namespace Baucells\Items\Console\Commands;

use Baucells\Items\Models\Item;
use Illuminate\Console\Command;
use Mockery\Exception;

/**
 * Class CreateItemCommand.
 * @package Baucells\Items\Console\Commands
 */
class CreateItemCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'item:create {name? : The item name} {description? : The item description}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new item';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            Item::create([
                'name' => $this->argument('name') ? $this->argument('name') : $this->ask('Item name?'),
                'description' => $this->argument('description') ? $this->argument('description') : $this->ask('Item description?')
            ]);
        } catch ( Exception $e) {
            $this->error('Error');
        }
        $this->info('Item has been added to database succesfully');
    }
}
