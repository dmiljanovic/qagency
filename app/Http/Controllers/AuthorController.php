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
        $token = request()->session()->get('user_data')['token_key'];
        $url = 'https://symfony-skeleton.q-tests.com/api/v2/authors?orderBy=id&direction=ASC&limit=12&page=1';

        $makeCall = $this->curlService->callAPI('GET', $url, [], $token);
        $response = json_decode($makeCall, true);

        if(isset($response['status'])) {
            Log::error('Error while getting authors: ', ['message' => $response['trace']]);
            request()->session()->flash('message', 'Unexpected error, please try again later.');

            return redirect()->back();
        }

        return view('author.index')->with('authors', $response['items']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $token = request()->session()->get('user_data')['token_key'];
        $url = 'https://symfony-skeleton.q-tests.com/api/v2/authors/' . $id;

        $makeCall = $this->curlService->callAPI('GET', $url, [], $token);
        $response = json_decode($makeCall, true);

        if(isset($response['status'])) {
            Log::error('Error while getting authors: ', ['message' => $response]);
            request()->session()->flash('message', 'Unexpected error, please try again later.');

            return redirect()->back();
        }

        return view('author.show')->with('author', $response);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        $token = request()->session()->get('user_data')['token_key'];
        $url = 'https://symfony-skeletons.q-tests.com/api/v2/authors/' . $id;

        $makeCall = $this->curlService->callAPI('DELETE', $url, [], $token);
        $response = json_decode($makeCall, true);

        if(isset($response['status'])) {
            Log::error('Error while getting authors: ', ['message' => $response]);
            request()->session()->flash('message', 'Unexpected error, please try again later.');

            return redirect()->back();
        }

        request()->session()->flash('message', 'Succesfully deleted author.');

        return redirect()->back();
    }
}
