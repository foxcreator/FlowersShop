<?php

namespace App\Console\Commands;

use App\Http\Services\Checkbox\CheckboxService;
use Illuminate\Console\Command;

class CloseCashRegister extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shift:close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close the cash register at the end of the day';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $checkboxService = new CheckboxService();
        $checkboxService->signInCashier();
        if ($checkboxService->getCashierShift()) {
            $checkboxService->closeShift();
        }
    }
}
