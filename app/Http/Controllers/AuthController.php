<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoggingRequest;
use App\Services\CurlService;
use Illuminate\Support\Facades\Log;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @var CurlService
     */
    protected $curlService;

    /**
     * AuthController constructor.
     *
     * @param CurlService $curlService
     */
    public function __construct(CurlService $curlService)
    {
        $this->curlService = new $curlService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function log()
    {
        return view('auth.login');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logging(LoggingRequest $request)
    {
        $dataArray =  array(
            "email" => $request->email,
            "password" => $request->password
        );
        
        $makeCall = $this->curlService->callAPI('POST', 'https://symfony-skeleton.q-tests.com/api/v2/token', json_encode($dataArray));
        $response = json_decode($makeCall, true);

        if(isset($response['status']) || isset($response['code'])) {
            Log::error('Error while getting authors: ', ['message' => $response]);
            request()->session()->flash('message', 'Unexpected error, please try again later.');

            return redirect()->back();
        }

        request()->session()->put((['user_data' => $response]));
        request()->session()->flash('message', 'Successfuly logged in');

        return redirect()->route('home.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        request()->session()->forget('user_data');
        request()->session()->flash('message', 'Goodbye.');

        return redirect()->route('home.index');
    }
}
