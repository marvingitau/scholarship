<?php

namespace App\Exports;

use App\Models\Admin\Communication;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CommunicationList implements FromView
{
   
  
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
      
        $data = Communication::join('beneficiaryforms','communications.beneficiary_id','=','beneficiaryforms.id')->get();

        return view('exports.contacts', [
            'slip' => $data
        ]);
    }
}
