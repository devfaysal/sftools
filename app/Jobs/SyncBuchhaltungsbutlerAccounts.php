<?php

namespace App\Jobs;

use App\Models\BuchhaltungsbutlerAccounts;
use App\Models\User;
use App\Services\BuchhaltungsbutlerService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncBuchhaltungsbutlerAccounts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(BuchhaltungsbutlerService $buchhaltungsbutler)
    {
        $response = $buchhaltungsbutler->getAccounts();
        $accounts = $response['data'];
        foreach($accounts as $account){
            if($account['postingaccount_number']){
                BuchhaltungsbutlerAccounts::updateOrCreate(
                    [
                        'user_id' => $this->user->id,
                        'postingaccount_number' => $account['postingaccount_number']
                    ],
                    ['name' => $account['name']]
                );
            }
        }
    }
}
