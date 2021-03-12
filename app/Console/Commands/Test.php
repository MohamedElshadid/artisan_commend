<?php

namespace App\Console\Commands;

use App\Account;
use App\Report;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:test {desc?}';

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
     * @return mixed
     */
    public function handle()
    {
        $desc = $this->argument('desc');
        if($desc)
        {
            $data = Report::join('accounts', 'accounts.account_id', '=', 'tests.test_account_id')
                            ->select( ['accounts.account_username',DB::raw('count(test_account_id) as count')])
                            ->groupBy('accounts.account_username')
                            ->orderBy('count','desc')
                            ->get();
        }
        else{
            $data = Report::join('accounts', 'accounts.account_id', '=', 'tests.test_account_id')
                            ->select( ['accounts.account_username',DB::raw('count(test_account_id) as count')])
                            ->groupBy('accounts.account_username')
                            ->orderBy('count','asc')
                            ->get();
        }
        $string = 'var dd= {
            content : '. $data .'
        }';
        
        File::put('resources/js/test.js','');
        File::append('resources/js/test.js', $string);


    }
}
