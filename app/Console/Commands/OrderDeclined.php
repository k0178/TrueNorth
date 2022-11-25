<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Biddings;
use Illuminate\Support\Carbon;
class OrderDeclined extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:OrderDeclined';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set status of unordered won auctions to Declined';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        $currentdate = Carbon::now()->format('Y-m-d');
        // $bids = Biddings::where('winstatus','Won')
        //                 ->where('orderstatus',0)
        //                 ->where('orderDate','<',$currentdate)  
        //                 ->get();
        
        // foreach ($bids as $bid) {
            
        //     Biddings::where('winstatus','Won')
        //             ->update(['orderDate'=> $orderDate]);

        // }

        Biddings::where('winstatus','Won')
        ->where('orderstatus',0)
        ->where('orderDate','<',$currentdate)  
        ->update(['winstatus'=>'Declined']);
    }
}
