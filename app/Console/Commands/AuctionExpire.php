<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Auction;
use App\Models\Inventory;
use Illuminate\Support\Carbon;

class AuctionExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auctions:auctionExp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auctions Expiration';

    /**
     * Execute the console command.
     *
     * @return int
     */

    // public function __construct(){
    //     parent::__construct();
    // }
    
    public function handle()
    {
        $auction = Auction::where('aucStatus',1)->get();
        $currentdate = Carbon::now()->format('Y-m-d');
        foreach($auction as $auc){
            $aucdate = Carbon::parse($auc->endDate);

            if($aucdate < $currentdate){
                Auction::where('aucStatus',1)
                        ->where('endDate','<',$currentdate)
                        ->update(['aucStatus' => 0]);
            }
        }
    }
}
