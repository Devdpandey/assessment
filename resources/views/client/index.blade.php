
@extends('layout')
@section('content')
<div class="action" style="display:inline-block;vertical-align:middle;width:100%;text-align:right;padding:10px">
<a class="btn btn-success" href="{{route('client.create')}}">Add Client</a>
</div>
<div class="table-division table-common">

                <div class="table-responsive">
                @if($formdata =='' || $formdata[0][0]['"'."Name".'"']=='') 
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
                                <th scope="col">{{$columns[8]}}</th>
                                <th scope="col">Action</th>
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
                                <td>{{$usr[7]['"'."Education".'"']}}</td>
                                <td>{{$usr[8]['"'."Preffered_Contact".'"']}}</td>
                                <td>
                                <a href="{{url('/client/'.$key.'/edit')}}" class="btn btn-primary">Edit</a>
                                <a href="{{url('/client/'.$key.'/delete')}}" class="btn btn-danger delete">Delete</a>
                                </td>
                            </tr>
                            @endif
                           
                            @endforeach
                        </tbody>
                    </table>
                @endif
                   
                </div>
            </div> 

<script>
$('.delete').on("click", function (e) {
    e.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            window.location.href = $(this).attr('href');
        }
    });
});
</script>   
@stop
