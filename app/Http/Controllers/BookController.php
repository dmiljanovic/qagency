<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Services\AuthorService;
use App\Services\BookService;
use App\Services\CurlService;
use Illuminate\Support\Facades\Log;

/**
 * Class BookController
 * @package App\Http\Controllers
 */
class BookController extends Controller
{
    /**
     * @var BookService
     */

    /**
     * @var AuthorService
     */
    protected $authorService;

    /**
     * @var BookService
     */
    protected $bookService;

    /**
     * BookController constructor.
     *
     * @param BookService $bookService
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $response = $this->bookService->getBooks();

        if(isset($response['status']) || isset($response['code'])) {
            Log::error('Error while getting authors: ', ['message' => $response]);
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
        $response = $this->authorService->getAuthors();

        if(isset($response['status']) || isset($response['code'])) {
            Log::error('Error while getting authors: ', ['message' => $response]);
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
        $response = $this->bookService->storeBook([]);

        if(isset($response['status']) || isset($response['code'])) {
            Log::error('Error while storing books: ', ['message' => $response]);
            request()->session()->flash('message', 'Unexpected error, please try again later.');

            return redirect()->back()->withInput();
        }

        request()->session()->flash('message', 'Succesfully created book.');

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete($id)
    {
        $response = $this->bookService->deleteBook($id);

        if(isset($response['status']) || isset($response['code'])) {
            Log::error('Error while deleting book: ', ['message' => $response]);
            request()->session()->flash('message', 'Unexpected error, please try again later.');

            return redirect()->back();
        }

        request()->session()->flash('message', 'Succesfully deleted book.');

        return redirect()->back();
    }
}
