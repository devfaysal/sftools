<?php

namespace App\Console\Commands;

use App\Models\Posting;
use App\Services\BuchhaltungsbutlerService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PostToBuchhaltungsbutler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'PostToBhb';

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
    public function handle(BuchhaltungsbutlerService $buchhaltungsbutler)
    {
        $today = Carbon::now();
        $scheduled_postings = Posting::where('schedule', $today->format('d'))->get();
        if($today->isLastOfMonth()){
            $scheduled_postings = Posting::where('schedule', 'Last day of Month')->get();
        }
        $scheduled_postings->map(function($posting) use ($buchhaltungsbutler){
            $buchhaltungsbutler->addFreePosting($posting);
        });
    }
}
