@extends('layout')
@section('content')
<form method="POST" action="{{route('client.store')}}">
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
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" required name="name" class="form-control" id="name" placeholder="Enter name">
</div>
<div class="form-group">
    <label for="gender">Gender</label>
    <select required name="gender" class="form-control" id="gender">
    <option value=""> Select gender</option>
    <option value="Male"> Male</option>
    <option value="Female"> Female</option>
    <option value="Other"> Other</option>
    </select>
</div>
<div class="form-group">
    <label for="phone">Phone</label>
    <input required name="phone" type="text" class="form-control" id="phone" placeholder="Enter phone">
</div>
<div class="form-group">
    <label for="email">Email address</label>
    <input type="email" required name="email" class="form-control" id="email"  placeholder="Enter email">
</div>
<div class="form-group">
    <label for="address">Address</label>
    <input type="text" class="form-control" name="address" id="address" placeholder="Enter address">
</div>
<div class="form-group">
    <label for="nationality">Nationality</label>
    <input type="text" class="form-control" name="nationality" id="nationality" placeholder="Enter address">
</div>
<div class="form-group">
    <label for="dob">Date of birth</label>
    <input type="text" class="form-control" name="dob" data-toggle="datepicker" readonly id="dob">
</div>
<div class="form-group">
    <label for="contact">Preffered mode of contact</label>
    <input type="radio" value="Email" class="form-control" name="preffered_mode" id="contact">Email
    <input type="radio" value="Phone" class="form-control" name="preffered_mode" id="contact">Phone
    <input type="radio" value="None" class="form-control" name="preffered_mode" id="contact">None
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
$(document).ready(function() {
    $('[data-toggle="datepicker"]').datepicker({ format: 'YYYY-mm-dd' });

});
</script>
@stop
