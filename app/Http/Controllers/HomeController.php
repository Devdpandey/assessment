<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientsExport;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
  
    public function __construct()
    {

    }

    public function index(Request $request)
    {  
        $clients='';
        $exists = Storage::disk('local')->exists('/exported-clients/clients-'.date('d-m-Y').'.csv');
        if($exists){
            $data = Storage::get('/exported-clients/clients-'.date('d-m-Y').'.csv');
           
            $csvData = array();
 

        while (($row = fgetcsv($data, 0, ",")) !== FALSE) {
            $csvData[] = $row;
        }
         
        dd(json_encode($csvData));
        }
       return view('client.index',compact('clients'));

            	
    }

    public function create()
    {
    	return view('client.create');
    }

    public function store(Request $request)
    {   

        $exists = Storage::disk('local')->exists('/exported-clients/clients-'.date('d-m-Y').'.csv');
        if($exists) { dd('already cha');}
        return Excel::store(new ClientsExport($request->all()), '/exported-clients/clients-'.date('d-m-Y').'.csv');
    }

   
}
