<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Services\MailJetEmail;
use App\Services\MailGunEmail;
use App\Repositories\LogRepository;

class EmailController extends Controller
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
     * Use for log model.
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
    public function __construct(LogRepository $log)
    {
        $this->log = $log;
    }

    /**
     * Show email form.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {   
        return view("emails.email");
    }

    /**
     * Validate incoming author request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required',
            'message' => 'required'
        ]);
    }
    
    /**
    * Process Email.
    *
    * @param  Request  $request
    * @return Json
    */
    public function send(Request $request)
    {        
        // Pass data for validation        
        $validator = $this->validator($request->all());

        // Check validation
        if ($validator->fails()) {
            return response()->json(
                ['error'=>$validator->errors()], 
                Response::HTTP_BAD_REQUEST
            );
        } else {            
            $data = [
                'email' => request('email'),
                'content' => request('message')
            ];

            // Mail Process
            if((new MailJetEmail($data))->send() != '200') { 
                // Fallback                 
                if(!(new MailGunEmail($data))->send()) {
                    $this->log->addLog($data);    
                } else {
                    $this->log->addLog($data, 'delivered');    
                }
            } else {
                $this->log->addLog($data, 'delivered');                
            }
        }
        
        return response()->json(['response' => true]);
    }
}
