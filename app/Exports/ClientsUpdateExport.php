<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClientsUpdateExport implements  FromView
{

 protected $data;

 function __construct($data) {
        $this->data = $data;
 }

    public function view(): View
    {    
        return view('exports.client-update-export', [
            'data' => $this->data,

        ]);
    }
}

