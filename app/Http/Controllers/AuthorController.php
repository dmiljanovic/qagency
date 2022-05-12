<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CurlService;
use Illuminate\Support\Facades\Log;

/**
 * Class HomeController
 * @package App\Http\Controllers\Home
 */
class AuthorController extends Controller
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
    public function index()
    {
        $url = 'https://symfony-skeleton.q-tests.com/api/v2/authors?orderBy=id&direction=ASC&limit=12&page=1';

        try {
            $makeCall = $this->curlService->callAPI('GET', $url, [], request()->session()->get('userData')['token_key']);
        } catch (\Exception $e) {
            Log::error('Error while getting authors: ', ['message' => $e]);
            request()->session()->flash('message', 'Unexpected error, please try again later.');

            return redirect()->back();
        }

        $response = json_decode($makeCall, true);

        if(isset($response['status'])) {
            Log::error('Error while getting authors: ', ['message' => $response['trace']]);
            request()->session()->flash('message', 'Unexpected error, please try again later.');

            return redirect()->back();
        }

        return view('author.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('author.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete()
    {
        return view('author.index');
    }
}
