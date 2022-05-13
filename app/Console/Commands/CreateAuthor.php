<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CurlService;
use Illuminate\Support\Facades\Log;

class CreateAuthor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:author';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new author';

    /**
     * @var string
     */
    protected $token;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CurlService $curlService)
    {
        parent::__construct();
        $this->curlService = new $curlService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->login();

        $data = $this->collectData();

        $url = 'https://symfony-skeleton.q-tests.com/api/v2/books';


        dd(json_encode($data));
        try {
            $makeCall = $this->curlService->callAPI('POST', $url, json_encode($data), $this->token);
        } catch (\Exception $e) {
            Log::error('Error while creating author form console: ', ['message' => $e]);
            $this->error('Unexpected error while creating author, please try again later.');

            die();
        }

        $response = json_decode($makeCall, true);

        if(isset($response['status'])) {
            Log::error('Error while creating author from console: ', ['message' => $response]);
            $this->error('Unexpected error while creating author, please try again later.');

            die();
        }

        $this->info('Succesfully created author.');
    }

    private Function login()
    {
        $dataArray =  array(
            "email" => 'ahsoka.tano@q.agency',
            "password" => 'Kryze4President'
        );
        
        try {
            $makeCall = $this->curlService->callAPI('POST', 'https://symfony-skeleton.q-tests.com/api/v2/token', json_encode($dataArray));
        } catch (\Exception $e) {
            Log::error('Error while login in from console: ', ['message' => $e]);
            $this->error('Unexpected error while login in, please try again later.');

            die();
        }

        $response = json_decode($makeCall, true);

        if(isset($response['status'])) {
            Log::error('Error while login in from console: ', ['message' => $response['trace']]);
            $this->error('Unexpected error while login in, please try again later.');

            die();
        }

        $this->token = $response['token_key'];
    }


    /**
     * Collect data form console.
     *
     * @return array
     */
    private function collectData()
    {
        return [
            "first_name"=> "string",
            "last_name"=> "string",
            "birthday"=> "2022-05-13T15:04:03.207Z",
            "biography"=> "string",
            "gender"=> "male",
            "place_of_birth"=> "string"
        ];
        // return [
        //     'first_name' => $this->ask('What is author first name?'),
        //     'last_name' => $this->ask('What is author last name?'),
        //     'birthday' => $this->ask('What is author birthday?'),
        //     'biography' => $this->ask('What is author biography?'),
        //     'gender' => $this->ask('What is author gender?'),
        //     'place_of_birth' => $this->ask('What is author place of birth?')
        // ];
    }
}
