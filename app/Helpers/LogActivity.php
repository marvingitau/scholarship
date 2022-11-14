<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\Models\LogActivity as LogActivityModel;


class LogActivity

{

    public  function addToLog($subject,Request $request)

    {

        $log = [];
        $log['subject'] = $subject;
        $log['url'] = $request->fullUrl();
        $log['method'] = $request->method();
        $log['ip'] = $request->ip();
        $log['agent'] = $request->header('user-agent');
        $log['user_id'] = auth()->check() ? auth()->user()->id : 1;
        // LogActivityModel::create($log);
    }


   
}
