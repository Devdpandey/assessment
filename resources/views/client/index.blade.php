
@extends('layout')
@section('content')
<div class="table-division table-common">
                <div class="table-responsive">
                @if($column='') 
                    <span>No data found!! please insert some data!</span>
                
                @else 
                    <table class="table table-borderless">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <thead>
                            <tr>
                                <th width="10%" scope="col">S.n.</th>
                                <th scope="col">{{$columns[0]}}</th>
                                <th scope="col">{{$columns[1]}}</th>
                                <th scope="col">{{$columns[2]}}</th>
                                <th scope="col">{{$columns[3]}}</th>
                                <th scope="col">{{$columns[4]}}</th>
                                <th scope="col">{{$columns[5]}}</th>
                                <th scope="col">{{$columns[6]}}</th>
                                <th scope="col">{{$columns[7]}}</th>
                            </tr>
                                </thead>
                         <tbody>
                        
                            @foreach($formdata as $key=>$usr)
                            @if($usr[0]['"'."Name".'"']!="")
                            <tr class="table-row">
                                <td>{{$key+1}}</td>
                                <td>{{$usr[0]['"'."Name".'"']}}</td>
                                <td>{{$usr[1]['"'."Gender".'"']}}</td>
                                <td>{{$usr[2]['"'."Phone".'"']}}</td>
                                <td>{{$usr[3]['"'."Email".'"']}}</td>
                                <td>{{$usr[4]['"'."Address".'"']}}</td>
                                <td>{{$usr[5]['"'."Nationality".'"']}}</td>
                                <td>{{$usr[6]['"'."DOB".'"']}}</td>
                                <td>{{$usr[7]['"'."Preffered_Contact".'"']}}</td>
                            </tr>
                            @endif
                           
                            @endforeach
                        </tbody>
                    </table>
                @endif
                   
                </div>
            </div>    
@stop
