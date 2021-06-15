@extends('layout')
@section('content')
<div class="col-md-6">
<form method="POST" action="{{route('client.update')}}">
@if ($errors->any())
        <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
        </div>
@endif
@csrf
<input type="hidden" name="key" value="{{Request::segment(2)}}"/>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" required name="name" class="form-control" id="name" value="{{str_replace('"','',$formdata[0]['"'."Name".'"'])}}" placeholder="Enter name">
</div>
<div class="form-group">
    <label for="gender">Gender</label>
    <select required name="gender" class="form-control" id="gender">
    <option value=""> Select gender</option>
    <option @if(str_replace('"','',$formdata[1]['"'."Gender".'"']) == 'Male') selected @endif value="Male"> Male</option>
    <option @if(str_replace('"','',$formdata[1]['"'."Gender".'"']) == 'Female') selected @endif value="Female"> Female</option>
    <option @if(str_replace('"','',$formdata[1]['"'."Gender".'"']) == 'Other') selected @endif value="Other"> Other</option>
    </select>
</div>
<div class="form-group">
    <label for="phone">Phone</label>
    <input required name="phone" type="text" value="{{str_replace('"','',$formdata[2]['"'."Phone".'"'])}}" class="form-control" id="phone" placeholder="Enter phone">
</div>
<div class="form-group">
    <label for="email">Email address</label>
    <input type="email" required name="email" value="{{str_replace('"','',$formdata[3]['"'."Email".'"'])}}" class="form-control" id="email"  placeholder="Enter email">
</div>
<div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" name="address" value="{{str_replace('"','',$formdata[4]['"'."Address".'"'])}}" id="address" placeholder="Enter address">
</div>
<div class="form-group">
    <label for="nationality">Nationality</label>
    <input type="text" class="form-control" name="nationality" value="{{str_replace('"','',$formdata[5]['"'."Nationality".'"'])}}" id="nationality" placeholder="Enter address">
</div>
<div class="form-group">
    <label for="dob">Date of birth</label>
    <input type="text" class="form-control" name="dob" value="{{str_replace('"','',$formdata[6]['"'."DOB".'"'])}}" data-toggle="datepicker" readonly id="dob">
</div>
<div class="form-group">
    <label for="contact">Preffered mode of contact</label>
    <input type="radio" value="Email" class="form-control" @if(str_replace('"','',$formdata[7]['"'."Preffered_Contact".'"']) == 'Email') checked @endif name="preffered_mode" id="contact">Email
    <input type="radio" value="Phone" class="form-control" @if(str_replace('"','',$formdata[7]['"'."Preffered_Contact".'"']) == 'Phone') checked @endif name="preffered_mode" id="contact">Phone
    <input type="radio" value="None" class="form-control" @if(str_replace('"','',$formdata[7]['"'."Preffered_Contact".'"']) == 'None') checked @endif name="preffered_mode" id="contact">None
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<script>
$(document).ready(function() {
    $('[data-toggle="datepicker"]').datepicker({ format: 'YYYY-mm-dd' });

});
</script>
@stop
