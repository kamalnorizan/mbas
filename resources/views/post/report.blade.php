<table width='100%' border='1'>
    <tr>
        <th>Bil</th>
        <th>Tajuk</th>
        <th>Slug</th>
    </tr>
    @foreach($posts as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->title }}</td>
        <td>{{ $p->slug }}</td>
    </tr>
    @endforeach
</table>
