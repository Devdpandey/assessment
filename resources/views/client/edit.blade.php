@extends('layout')
@section('content')
<div class="col-md-12">
<div class="clientform" style="max-width:550px;margin:0 auto;padding:30px;">
<h1>Client Details</h1>
<form method="POST" id="form" action="{{route('client.update')}}">
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
    <label for="education">Education Background</label>
    <input type="text" class="form-control" name="education" value="{{str_replace('"','',$formdata[7]['"'."Education".'"'])}}" id="education" placeholder="Enter education background">
</div>
<div class="form-group">
    <label for="contact">Preffered mode of contact</label>
    <div class="options">
    <input type="radio" value="Email" class="form-control" @if(str_replace('"','',$formdata[8]['"'."Preffered_Contact".'"']) == 'Email') checked @endif name="preffered_mode" id="contact"><label>Email</label>
    </div>
    <div class="options">
    <input type="radio" value="Phone" class="form-control" @if(str_replace('"','',$formdata[8]['"'."Preffered_Contact".'"']) == 'Phone') checked @endif name="preffered_mode" id="contact"><label>Phone</label>
    </div>
    <div class="options">
    <input type="radio" value="None" class="form-control" @if(str_replace('"','',$formdata[8]['"'."Preffered_Contact".'"']) == 'None') checked @endif name="preffered_mode" id="contact"><label>None</label>
    </div>
</div>
<div class="submitbtn">
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
</div>
</div>

<style>
.options{
    display:flex;
    align-items:center;
    width:300px;

}

.options input {
    width: 20px;
    margin: 0 10px 0 0;
}

.options label {
    margin: 0;
}

.clientform h1{
    font-size: 27px;
    line-height: 32px;
    margin: 0 0 25px;
    text-align: center;

}
.submitbtn {
    text-align: center;
}
.submitbtn button {
    width: 150px;
}

</style>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
$(document).ready(function() {
    $('[data-toggle="datepicker"]').datepicker({ format: 'YYYY-mm-dd' });

});

$(document).ready(function () {
    $('#form').validate({ // initialize the plugin
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                
            },
            address: {
                required: true,
                
            },
            education: {
                required: true,
                
            },
            gender: {
                required: true,
                
            },
            nationality: {
                required: true,
                
            },
            dob: {
                required: true,
                
            },
            preffered_mode: {
                required: true,
                
            },
        }
    });
});
</script>
@stop
