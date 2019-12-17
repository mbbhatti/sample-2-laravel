<?php

namespace App\Repositories;

use App\Log;

class LogRepository implements LogRepositoryInterface
{
    /**
     * Add log one by one.
     *
     * @param  array  $data
     * @param  string  $status
     * @return boolean    
     */
    public function addLog(array $data, string $status = ''): boolean
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
     * Get log email and status list.
     *     
     * @return array $list
     */
    public function getLogs(): array
    {
        $list = Log::all(['email', 'status'])
                    ->toArray();       

        return $list;
    }
}