<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'message'
    ];

    /**
     * Add log oe by one.
     *
     * @param  array   $data
     * @return boolean    
     */
    public function addLog(array $data, string $status = '')
    {
        $list = preg_split("/[;,]+/", $data['email']);    
        
        foreach ($list as $email) {
            $log = new Log();

            $log->email = trim($email);
            $log->message = $data['content'];
            if(isset($status)) {
                $log->status = 'delivered';    
            }        
            
            $log->save();
        }
        
        return true;
    }

    /**
     * Get email status list.
     *     
     * @return array $list
     */
    public function getAll()
    {
        $list = Log::all(['email', 'status'])
                    ->toArray();       

        return $list;
    }
}
