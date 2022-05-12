<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoggingRequest;
use App\Services\CurlService;
use Illuminate\Support\Facades\Http;
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
        
        try {
            $makeCall = $this->curlService->callAPI('POST', 'https://symfony-skeleton.q-tests.com/api/v2/token', json_encode($dataArray));
        } catch (\Exception $e) {
            Log::error('Error while calling curl service: ', ['message' => $e]);
            request()->session()->flash('message', 'Unexpected error, please try again later.');

            return redirect()->back();
        }

        //TODO Check the case when $makeCall is null
        request()->session()->put((['userData' => json_decode($makeCall, true)]));
        request()->session()->flash('message', 'Successfuly logged in');

        return redirect()->route('home.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        request()->session()->forget('userData');

        return redirect()->route('home.index');
    }
}