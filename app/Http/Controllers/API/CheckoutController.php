<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Books;


use Validator;

class CheckoutController extends BaseController
{


    /**
     * Display a listing of all Checkout.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = Books::find($request->book_id);
        if (!$book) {
            return $this->sendError('Invalid Book');
        }
        $validator = Validator::make($request->all(), [

            'book_id' => 'required',
            'checkout_date' => 'required',


        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['user_id'] = auth('api')->user()->id;


        try {
            $Books = Checkout::create($input);
            $book->copies =  $book->copies - 1;
            $book->save();

            return $this->sendResponse($Books, 'Checkout created successfully.');
        } catch (Exception $e) {
            return $this->sendError('Unauthorised.', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Display  Checkout.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCheckout($id)
    {
        try {

            $book = Checkout::find($id);
            return $this->sendResponse($book, 'Checkout Fetched Successfully');
        } catch (Exception $e) {
            return $this->sendError('Unauthorised.', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Update Checkout.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCheckout($id, Request $request)
    {
        try {

            $Checkout = Checkout::find($id);
            if (!$Checkout) {
                return $this->sendError('Invalid Checkout');
            }
            if ($Checkout->return_date) {
                return $this->sendError('Invalid Checkout');
            }
            $validator = Validator::make($request->all(), [
                'book_id' => 'required',
                'return_date' => 'required',

            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $Checkout->return_date =  $request->return_date;
            $Checkout->save();

            $book = Books::find($request->book_id);
            $book->copies =  $book->copies + 1;
            $book->save();
            return $this->sendResponse([], 'Checkout Cancelled');
        } catch (Exception $e) {
            return $this->sendError('Unauthorised.', ['error' => $e->getMessage()]);
        }
    }
}
