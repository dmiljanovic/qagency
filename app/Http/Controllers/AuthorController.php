<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\AuthorService;
use Illuminate\Support\Facades\Log;

/**
 * Class AuthorController
 * @package App\Http\Controllers
 */
class AuthorController extends Controller
{
    /**
     * @var AuthorService
     */
    protected $authorService;

    /**
     * AuthController constructor.
     *
     * @param AuthorService $authorService
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }
    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $response = $this->authorService->getAuthors();

        if(isset($response['status']) || isset($response['code'])) {
            Log::error('Error while getting authors: ', ['message' => $response]);
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
        $response = $this->authorService->getAuthor($id);

        if(isset($response['status']) || isset($response['code'])) {
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
        $response = $this->authorService->deleteAuthor($id);

        if(!$response) {
            request()->session()->flash('message', 'You are not allowed to delete author with books.');

            return redirect()->back();
        }

        if(isset($response['status']) || isset($response['code'])) {
            Log::error('Error while getting authors: ', ['message' => $response]);
            request()->session()->flash('message', 'Unexpected error, please try again later.');

            return redirect()->back();
        }

        request()->session()->flash('message', 'Succesfully deleted author.');

        return redirect()->back();
    }
}
