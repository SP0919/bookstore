<?php

namespace App\Console\Commands;

use App\Models\Orders;
use Illuminate\Console\Command;

class OrdersCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
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
        $this->implement();
    }
    public function implement()
    {
        $expDate = Carbon::now();
        $getAllOrders = Orders::where('status', 'ONTIME')->whereDate('delivery_date', '>', $expDate)->limit(50)->get();
        foreach ($getAllOrders as $order) {
            Orders::where('id', $order->id)->update(['status' => "SLIGHTDELAY"]);
        }
        return true;
    }
}
