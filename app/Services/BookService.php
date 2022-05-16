<?php

namespace App\Services;

use App\Services\CurlService;

class BookService
{
    /**
     * @var CurlService
     */
    protected $curlService;

    /**
     * BookService constructor.
     *
     * @param CurlService $curlService
     */
    public function __construct(CurlService $curlService)
    {
        $this->curlService = $curlService;
    }

    /**
     * @return array
     */
    public function getBooks()
    {
        $token = request()->session()->get('user_data')['token_key'];
        $url = 'https://symfony-skeleton.q-tests.com/api/v2/books?orderBy=id&direction=ASC&limit=12&page=1';

        $makeCall = $this->curlService->callAPI('GET', $url, [], $token);

        return json_decode($makeCall, true);
    }

    /**
     * @param array $input
     * @return array
     */
    public function storeBook($input)
    {
        $input['author'] = (array)$input['author'];
        $input['number_of_pages'] = (int) $input['number_of_pages'];
        
        $token = request()->session()->get('user_data')['token_key'];
        $url = 'https://symfony-skeleton.q-tests.com/api/v2/books';

        $makeCall = $this->curlService->callAPI('POST', $url, json_encode($input), $token);

        return json_decode($makeCall, true);
    }

    /**
     * @param string $id
     * @return array
     */
    public function deleteBook($id)
    {
        $token = request()->session()->get('user_data')['token_key'];
        $url = 'https://symfony-skeleton.q-tests.com/api/v2/books/' . $id;

        $makeCall = $this->curlService->callAPI('DELETE', $url, [], $token);
        return json_decode($makeCall, true);
    }
}
