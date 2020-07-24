<!DOCTYPE html>
<html>
<head>
	<title>Example</title>
</head>
<body>
	<table border="1">
		<caption>Вывод из БД</caption>
		<tr>
			<th>ID</th>
			<th>Название акции</th>
			<th>Дата начала</th>
			<th>Дата завершения</th>
			<th>Статус</th>
			<th>URL</th>
		</tr>
		@foreach($data as $d)
		<tr>
			<td>{{$d->id}}</td>
			<td>{{$d->name}}</td>
			<td>{{date('d-m-Y', $d->start_at)}}</td>
			<td>{{date('d-m-Y', $d->finish_at)}}</td>
			<td>{{$d->status}}</td>
			<td>{{$d->url}}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>