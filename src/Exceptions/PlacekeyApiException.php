<?php

namespace Realtydev\LaravelPlacekey\Exceptions;

use Exception;

class PlacekeyApiException extends Exception
{
    /**
     * The exception message.
     *
     * @var string
     */
    protected $message;

    /**
     * The exception code.
     *
     * @var int
     */
    protected $code;

    /**
     * Create a new exception instance.
     *
     * @param  string  $message
     * @param  int  $code
     * @return void
     */
    public function __construct($message, $code = 400)
    {
        parent::__construct($message, $code);
    }

    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json([
            'error' => [
                'message' => $this->message,
                'status_code' => $this->code,
            ],
        ], $this->code);
    }
}
