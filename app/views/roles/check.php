@foreach($list_UserRoles as $item)
<h1>{{$item['Id']}}</h1><br>
{{$item['Fullname']}}
@endforeach
