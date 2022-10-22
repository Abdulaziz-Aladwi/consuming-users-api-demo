<?php

namespace App\Console\Commands;

use App\Constants\UserEndpoints;
use App\Services\UserDataService;
use App\Services\UsersApiClientService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserApiConsumer extends Command
{
    const BATCH_SIZE = 20;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consume:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to consume users from external APIs and bulk inset into database';

    /**
     * @var UsersApiClientService
     */
    private $client;

    /**
     * @var UserDataService
     */
    private $userDataService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UsersApiClientService $client, UserDataService $userDataService)
    {
        $this->client = $client;
        $this->userDataService = $userDataService;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $batchSize = self::BATCH_SIZE;

            $response1 = $this->client->get(UserEndpoints::users_1);
            $response2 = $this->client->get(UserEndpoints::users_2);

            $users1 = $this->userDataService->prepareDataForUsers1($response1);        
            $users2 = $this->userDataService->prepareDataForUsers2($response2);

            $usersCollection = $users1->merge($users2);

            foreach ($usersCollection->chunk($batchSize) as $index => $users) {

                DB::table('users')->insert($users->toArray());

                $this->info("Data for Batch# {$index} Saved Successfully");
            }

            $this->info('Succeeded');

        } catch(\Exception $exception) {
            $this->error('Something went wrong, please check logs.');
            Log::error($exception->getMessage());
        }
    }
}
