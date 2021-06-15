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
        $columns='';
        $formdata='';
        $exists = Storage::disk('local')->exists('/exported-clients/clients-'.date('d-m-Y').'.csv');
        if($exists){
            $data = Storage::get('/exported-clients/clients-'.date('d-m-Y').'.csv');
            $clients = explode("\n", $data) ; // create an array of 2 entry (first line, and the rest).
            // dd($clients);
            $columns = $this->getColumnNames($clients);
            $formdata = $this->getColumnData($clients,$columns);
            // dd($formdata[0]);
        }
       return view('client.index',compact('columns','formdata'));

            	
    }

    private function getColumnNames($firstArray=null){
        if(!$firstArray) return null;
        $column = array();
        $data = explode(",",$firstArray[0]);
        foreach($data as $key => $heading){
            $column[] = $heading;
        }
        return $column;
    }
    private function getColumnData($clients=null,$columns=null){
       
        $responseData = array();
        $i=0;
        foreach($clients as $k=>$clientData){
       
            if($clientData == $clients[0]){
                continue;
            }else{
                $response = array();
                $data = explode(",",$clientData);
                $k=0;
                foreach($columns as $key=>$column){
                    $response[] = array($column => @$data[$key]);
                }
            }
            $i++;
            $responseData[] = $response;
        }
        return $responseData;
    }

    public function create()
    {
    	return view('client.create');
    }

    public function store(Request $request)
    {   

        $exists = Storage::disk('local')->exists('/exported-clients/clients-'.date('d-m-Y').'.csv');
        if($exists) {
            Excel::import('/exported-clients/clients-'.date('d-m-Y').'.csv', function($reader) 
            {
                $reader->sheet(function($sheet) 
                {
                    $sheet->appendRow([
                         $request->name, $request->gender,$request->phone,$request->email,$request->address,$request->nationality,$request->preffered_mode
                     ]);
                });
            })->export('csv');
            }
        return Excel::store(new ClientsExport($request->all()), '/exported-clients/clients-'.date('d-m-Y').'.csv');
    }

   
}
