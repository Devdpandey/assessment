<table>
<thead>
<tr>
<th>Name</th>
<th>Gender</th>
<th>Phone</th>
<th>Email</th>
<th>Address</th>
<th>Nationality</th>
<th>DOB</th>
<th>Education</th>
<th>Preffered_Contact</th>
</tr>
</thead>
<tbody>
@foreach($data as $usr)
@if($usr[0]['"'."Name".'"']!="")
    <tr>
    <td>{{str_replace('"','',$usr[0]['"'."Name".'"'])}}</td>
    <td>{{str_replace('"','',$usr[1]['"'."Gender".'"'])}}</td>
    <td>{{str_replace('"','',$usr[2]['"'."Phone".'"'])}}</td>
    <td>{{str_replace('"','',$usr[3]['"'."Email".'"'])}}</td>
    <td>{{str_replace('"','',$usr[4]['"'."Address".'"'])}}</td>
    <td>{{str_replace('"','',$usr[5]['"'."Nationality".'"'])}}</td>
    <td>{{str_replace('"','',$usr[6]['"'."DOB".'"'])}}</td>
    <td>{{str_replace('"','',$usr[7]['"'."Education".'"'])}}</td>
    <td>{{str_replace('"','',$usr[8]['"'."Preffered_Contact".'"'])}}</td>
    </tr>
@endif
@endforeach
</tbody>
</table>