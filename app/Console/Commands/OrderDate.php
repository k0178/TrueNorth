<?php

namespace App\Console\Commands;
use App\Models\Biddings;
use App\Models\User;
use App\Models\Auction;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class OrderDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:SetOrderDate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Must Place order within 14 days ';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   

        $bids = Biddings::where('winstatus','Won')->get();

        foreach ($bids as $bid) {
            
            $orderDate = $bid->updated_at->addDays(14);
            Biddings::where('winstatus','Won')
                    ->update(['orderDate'=> $orderDate]);

        }
        
    }
}
