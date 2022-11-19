<?php

namespace App\Jobs;

use App\Models\Admin\Communication;
use Mail;
use Illuminate\Bus\Queueable;
use App\Models\Admin\StudyMaterial;
use App\Models\Clerk\Beneficiaryform;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;


class SendQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    public $timeout = 7200; // 2 hours
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = Communication::where('beneficiary_type',$this->details['category'])->get();
        $path = StudyMaterial::where('id',$this->details['id'])->first()->file_path;
        
        $input['subject'] = "Study Material";
        $input['path'] = storage_path('app/public/'.$path);

     
        

        foreach ($data as $key => $value) {
            $input['email'] = $value->email;
            $input['name'] = $value->belongsto;

            \Mail::send('mail.studymaterial', [], function($message) use($input){
                $message->to($input['email'], $input['name'])->subject($input['subject']);
                $message->attach($input['path']);
              

            });
        }
    }
}
