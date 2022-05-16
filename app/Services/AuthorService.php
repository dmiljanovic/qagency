<?php

namespace App\Services;

use App\Services\CurlService;

class AuthorService
{
    /**
     * @var CurlService
     */
    protected $curlService;

    /**
     * AuthorService constructor.
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
    public function getAuthors()
    {
        $token = request()->session()->get('user_data')['token_key'];
        $url = 'https://symfony-skeleton.q-tests.com/api/v2/authors?orderBy=id&direction=ASC&limit=12&page=1';

        $makeCall = $this->curlService->callAPI('GET', $url, [], $token);

        return json_decode($makeCall, true);
    }

    /**
     * @param string $id
     * @return array
     */
    public function getAuthor($id)
    {
        $token = request()->session()->get('user_data')['token_key'];
        $url = 'https://symfony-skeleton.q-tests.com/api/v2/authors/' . $id;

        $makeCall = $this->curlService->callAPI('GET', $url, [], $token);

        return json_decode($makeCall, true);
    }

    /**
     * @param string $id
     * @return array
     */
    public function deleteAuthor($id)
    {
        $hasBooks = $this->authorHasBook($id);
        if($hasBooks) {
            return false;
        }

        $token = request()->session()->get('user_data')['token_key'];
        $url = 'https://symfony-skeletons.q-tests.com/api/v2/authors/' . $id;

        $makeCall = $this->curlService->callAPI('DELETE', $url, [], $token);

        return json_decode($makeCall, true);
    }

    /**
     * @return bool
     */
    private function authorHasBook($id)
    {
        $author =  $this->getAuthor($id);

        if($author['books']) {
            return true;
        }

        return false;
    }
}
