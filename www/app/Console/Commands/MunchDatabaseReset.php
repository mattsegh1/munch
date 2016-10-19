<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class MunchDatabaseReset.
 *
 * Use:
 * $ php artisan munch:database:reset
 *
 * @author Olivier Parent <olivier.parent@arteveldehs.be>
 * @copyright Copyright © 2015-2016, Artevelde University College Ghent
 */
class MunchDatabaseReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'munch:database:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drops and runs munch:database:init';

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
        // Get variables from `.env`
        $dbName = getenv('DB_DATABASE');

        // Drop database and initialize
        $this->callSilent('munch:database:drop');
        $this->callSilent('munch:database:init');

        $this->comment("Database `${dbName}` reset!");
    }
}