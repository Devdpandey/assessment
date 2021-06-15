<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClientsExport implements  FromView
{

 protected $centers;

 function __construct($data) {
        $this->data = $data;
 }

    public function view(): View
    {    
        return view('exports.client-export', [
            'data' => $this->data,

        ]);
    }
}

