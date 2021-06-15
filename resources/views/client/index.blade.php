
@extends('layout')
@section('content')
<div class="table-division table-common">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <thead>
                            <tr>
                                <th width="10%" scope="col">S.n.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Gender</th>
                            </tr>
                                </thead>
                         <tbody>
                            @foreach($clients as $key=>$usr)
                            <tr class="table-row">
                                <td>{{$key+1}}</td>
                                <td>{{$usr->name}}</td>
                                <td>{{$usr->gender}}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>    
@stop
