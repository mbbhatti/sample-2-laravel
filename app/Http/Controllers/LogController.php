<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Log;

class LogController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles transactional email with status log.
    |
    */    

    /**
     * Use for email log.
     *
     * @var string
     */
    protected $log;

    /**
     * Create a new controller instance.
     *
     * @param  $log Log object
     * @return void
     */
    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    /**
     * Show logs.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {                 
        return view("emails.logs");
    }

    /**
     * Retrive log data.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {                 
        $data = $this->log->getAll();

        return response()->json($data, Response::HTTP_OK);
    }
}
