<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Services\CurlService;
use Illuminate\Support\Facades\Log;

/**
 * Class HomeController
 * @package App\Http\Controllers\Home
 */
class BookController extends Controller
{
    /**
     * @var CurlService
     */
    protected $curlService;

    /**
     * @var string
     */
    protected $token;

    /**
     * AuthController constructor.
     *
     * @param CurlService $curlService
     */
    public function __construct(CurlService $curlService)
    {
        $this->curlService = new $curlService;
        $this->token = request()->session()->get('user_data')['token_key'];
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $url = 'https://symfony-skeleton.q-tests.com/api/v2/books?orderBy=id&direction=ASC&limit=12&page=1';

        try {
            $makeCall = $this->curlService->callAPI('GET', $url, [], $this->token);
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

        return view('book.index')->with('books', $response['items']);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $url = 'https://symfony-skeleton.q-tests.com/api/v2/authors?orderBy=id&direction=ASC&limit=100&page=1';

        try {
            $makeCall = $this->curlService->callAPI('GET', $url, [], $this->token);
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

        $authors = collect($response['items'])->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['first_name'] . ' ' . $item['last_name']];
        });

        return view('book.create')->with('authors', $authors);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(StoreBookRequest $request)
    {
        $input = $request->validated();
        $input['number_of_pages'] = (int) $input['number_of_pages'];
        
        $url = 'https://symfony-skeleton.q-tests.com/api/v2/books';

        try {
            $makeCall = $this->curlService->callAPI('POST', $url, json_encode($input), $this->token);
        } catch (\Exception $e) {
            Log::error('Error while getting books: ', ['message' => $e]);
            request()->session()->flash('message', 'Unexpected error, please try again later.');

            return redirect()->back()->withInput();
        }

        $response = json_decode($makeCall, true);

        if(isset($response['status'])) {
            Log::error('Error while getting books: ', ['message' => $response['trace']]);
            request()->session()->flash('message', 'Unexpected error, please try again later.');

            return redirect()->back()->withInput();
        }

        return view('book.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        $url = 'https://symfony-skeleton.q-tests.com/api/v2/books/' . $id;

        try {
            $makeCall = $this->curlService->callAPI('DELETE', $url, [], $this->token);
        } catch (\Exception $e) {
            Log::error('Error while deleting books: ', ['message' => $e]);
            request()->session()->flash('message', 'Unexpected error, please try again later.');

            return redirect()->back();
        }

        $response = json_decode($makeCall, true);

        if(isset($response['status'])) {
            Log::error('Error while deleting book: ', ['message' => $response['trace']]);
            request()->session()->flash('message', 'Unexpected error, please try again later.');

            return redirect()->back();
        }

        request()->session()->flash('message', 'Succesfully deleted book.');

        return redirect()->back();
    }
}
