<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Books;
use Validator;

class BookController extends BaseController
{
    /**
     * Display a listing of all Books.
     *
     * @return \Illuminate\Http\Response
     */
    public function Books($book = "All")
    {
        try {

            $book = Books::get();
            return $this->sendResponse($book, 'Books Fetched Successfully');
        } catch (Exception $e) {
            return $this->sendError('Unauthorised.', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Create Books.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required',
            'copies' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input = $request->all();
        try {
            $Books = Books::create($input);


            return $this->sendResponse($Books, 'Book register successfully.');
        } catch (Exception $e) {
            return $this->sendError('Unauthorised.', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Display a listing of  Book.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBook($id)
    {
        try {

            $book = Books::find($id);
            return $this->sendResponse($book, 'Book Fetched Successfully');
        } catch (Exception $e) {
            return $this->sendError('Unauthorised.', ['error' => $e->getMessage()]);
        }
    }

    /**
     * update Books.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateBook($id, Request $request)
    {
        try {

            $book = Books::find($id);
            if (!$book) {
                return $this->sendError('Invalid Book');
            }
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'author' => 'required',
                'isbn' => 'required',
                'copies' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $book->title = $request->title;
            $book->author = $request->author;
            $book->isbn = $request->isbn;
            $book->copies = $request->copies;
            $book->save();
            return $this->sendResponse($book, 'Book Updated Successfully');
        } catch (Exception $e) {
            return $this->sendError('Unauthorised.', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Display a listing of  Books.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteBook($id)
    {
        try {

            $Books = Books::find($id);
            if (!$Books) {
                return $this->sendError('Invalid Book');
            }
            $Books->delete();
            return $this->sendResponse('', 'Book Deleted Successfully');
        } catch (Exception $e) {
            return $this->sendError('Unauthorised.', ['error' => $e->getMessage()]);
        }
    }
}
