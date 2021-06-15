<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientsExport;
use App\Exports\ClientsUpdateExport;
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

    public function create()
    {
    	return view('client.create');
    }

    public function store(Request $request)
    {   
        $validated = $request->validate([
            'name'  => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
            'gender'=> 'required|in:Male,Female,Other',
            'address' => 'required',
            'nationality' => 'required',
            'dob' => 'required|date_format:Y-m-d|before:today',
            'preffered_mode' => 'required|in:Email,Phone,None',
            ]);
        $exists = Storage::disk('local')->exists('/exported-clients/clients-'.date('d-m-Y').'.csv');
        if($exists) {
            $data = Storage::get('/exported-clients/clients-'.date('d-m-Y').'.csv');
            $clients = explode("\n", $data) ; // create an array of 2 entry (first line, and the rest).
            // dd($clients);
            $columns = $this->getColumnNames($clients);
            $formdata = $this->getColumnData($clients,$columns);
            $index = count($formdata);
            $formdata[$index][0]['"'."Name".'"']= $request->name;
            $formdata[$index][1]['"'."Gender".'"']= $request->gender;
            $formdata[$index][2]['"'."Phone".'"']= $request->phone;
            $formdata[$index][3]['"'."Email".'"']= $request->email;
            $formdata[$index][4]['"'."Address".'"']= str_replace(",","-",$request->address);
            $formdata[$index][5]['"'."Nationality".'"']= $request->nationality;
            $formdata[$index][6]['"'."DOB".'"']= $request->dob;
            $formdata[$index][7]['"'."Preffered_Contact".'"']= $request->preffered_mode;
            Excel::store(new ClientsUpdateExport($formdata), '/exported-clients/clients-'.date('d-m-Y').'.csv');
            return redirect('/')->with('success','client updated successfully!!');
            
            }
        Excel::store(new ClientsExport($request->all()), '/exported-clients/clients-'.date('d-m-Y').'.csv');
        return redirect('/')->with('success','client successfully added!');
    }

    public function edit($key){
        $data = Storage::get('/exported-clients/clients-'.date('d-m-Y').'.csv');
        $clients = explode("\n", $data) ; // create an array of 2 entry (first line, and the rest).
        // dd($clients);
        $columns = $this->getColumnNames($clients);
        $formdata = $this->getColumnData($clients,$columns);
        $formdata = @$formdata[$key];
        if(!$formdata){
            abort('404');
        }
        return view('client.edit',compact('formdata'));
    }

    public function update(Request $request) {
        $validated = $request->validate([
            'name'  => 'required|min:2',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
            'gender'=> 'required|in:Male,Female,Other',
            'address' => 'required',
            'nationality' => 'required',
            'dob' => 'required|date_format:Y-m-d|before:today',
            'preffered_mode' => 'required|in:Email,Phone,None',
            ]);

            $data = Storage::get('/exported-clients/clients-'.date('d-m-Y').'.csv');
            $clients = explode("\n", $data) ; // create an array of 2 entry (first line, and the rest).
            // dd($clients);
            $columns = $this->getColumnNames($clients);
            $formdata = $this->getColumnData($clients,$columns);
            $update = $formdata[$request->key];
            $formdata[$request->key][0]['"'."Name".'"']= $request->name;
            $formdata[$request->key][1]['"'."Gender".'"']= $request->gender;
            $formdata[$request->key][2]['"'."Phone".'"']= $request->phone;
            $formdata[$request->key][3]['"'."Email".'"']= $request->email;
            $formdata[$request->key][4]['"'."Address".'"']= str_replace(",","-",$request->address);
            $formdata[$request->key][5]['"'."Nationality".'"']= $request->nationality;
            $formdata[$request->key][6]['"'."DOB".'"']= $request->dob;
            $formdata[$request->key][7]['"'."Preffered_Contact".'"']= $request->preffered_mode;
            // dd($formdata);
            Excel::store(new ClientsUpdateExport($formdata), '/exported-clients/clients-'.date('d-m-Y').'.csv');
            return redirect('/')->with('success','client updated successfully!!');

    }

    public function delete($key){
        $data = Storage::get('/exported-clients/clients-'.date('d-m-Y').'.csv');
        $clients = explode("\n", $data) ; // create an array of 2 entry (first line, and the rest).
        // dd($clients);
        $columns = $this->getColumnNames($clients);
        $formdata = $this->getColumnData($clients,$columns);
        $delete = @$formdata[$key];
        if(!$delete){
            abort('404');
        }
        unset($formdata[$key]);
        Excel::store(new ClientsUpdateExport($formdata), '/exported-clients/clients-'.date('d-m-Y').'.csv');
        return redirect('/')->with('success','client deleted successfully!!');
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

   
}
