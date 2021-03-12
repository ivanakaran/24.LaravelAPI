<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Illuminate\Console\Command;

class DeleteSoftDeletes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:vehicle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes soft deleted and vehicles with expired insurance';

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
        $vehicles = Vehicle::withTrashed()->whereNotNull('deleted_at')->OrWhere('insurance_date', '<', date('Y-m-d'));
        $vehicles->forceDelete();
        $this->info('Vehicle deleted!');
    }
}