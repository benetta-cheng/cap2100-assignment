<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CreateDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set RDS_DB_NAME environment variable and create the database. Only run for the first time';

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
     * @return int
     */
    public function handle()
    {

        file_put_contents(app()->environmentFilePath(), str_replace(
            'RDS_DB_NAME=' . Config::get('database.connections.mysql.database'),
            'RDS_DB_NAME=cap2100_system',
            file_get_contents(app()->environmentFilePath())
        ));

        $this->info("Changed RDS_DB_NAME environment variable in .env to cap2100_system");

        // Make the database empty first to not specify a database when connecting to the database server
        Config::set('database.connections.mysql.database', '');

        try {
            $dbname = 'cap2100_system';
            $connection = env('DB_CONNECTION', 'mysql');
            $hasDb = DB::connection($connection)->select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = " . "'" . $dbname . "'");

            if (empty($hasDb)) {
                DB::connection($connection)->select('CREATE DATABASE ' . $dbname);
                $this->info("Database '$dbname' created for '$connection' connection");
            } else {
                $this->info("Database '$dbname' already exists for '$connection' connection");
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        // Reload the cached config       
        if (file_exists(app()->getCachedConfigPath())) {
            $this->call("config:cache");
        }
    }
}
