<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Biddings;
use App\Models\User;
use App\Models\Auction;
use Illuminate\Support\Carbon;

class WinStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bid:winStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Win Status';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   $currentdate = Carbon::now()->format('Y-m-d');
        Biddings::select('*')
        ->whereRaw('bidamt in (select max(bidamt) from bidtransactions b
                where bidtransactions.prod_id = b.prod_id)')
        // ->whereRaw('id = (select min(id) from bidtransactions b
        // 			where bidtransactions.prod_id = b.prod_id)' )
        ->whereRaw('id in (select min(id) from bidtransactions b
        where bidtransactions.prod_id = b.prod_id)')
        ->where('bidstatus', 1)
        ->where('retractstat',0)
        ->where('orderstatus',0)
        ->where('endDate','<',$currentdate)
        ->update(['winstatus'=>'Won']);

        Biddings::select('*')
                ->where('bidstatus', 1)
                ->where('retractstat',0)
                ->where('orderstatus',0)
                ->where('endDate','>',$currentdate)
                ->update(['winstatus'=>'Pending']);
        
        Biddings::select('*')
        ->whereRaw('bidamt < (select max(bidamt) from bidtransactions b
                where bidtransactions.prod_id = b.prod_id)')
        // ->whereRaw('id = (select min(id) from bidtransactions b
        // 			where bidtransactions.prod_id = b.prod_id)' )
        ->whereRaw('id > (select min(id) from bidtransactions b
        where bidtransactions.prod_id = b.prod_id)')
        ->where('bidstatus', 1)
        ->where('retractstat',0)
        ->where('orderstatus',0)
        ->where('endDate','<',$currentdate)
        ->update(['winstatus'=>'Lost']);


    }
}
