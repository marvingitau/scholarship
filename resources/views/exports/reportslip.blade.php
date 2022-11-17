<table>
    <thead>
    <tr>
        <th>SCHOOL</th>
        <th>NAME</th>
        <th>YEAR</th>
        <th>FORM/CLASS</th>
        <th>TERM</th>
        <th>MEAN GRADE</th>
    </tr>
    </thead>
    <tbody>
    @foreach($slip as $item)
        <tr>
            <td>{{ $item->SecondaryAdmitted }}</td>
            <td>{{$item->firstname}} {{$item->lastname}}</td>
            <td>{{ $item->year }}</td>
            <td>{{ $item->form }}</td>
            <td>{{ $item->term }}</td>
            <td>{{ $item->meangrade }}</td>
        </tr>
    @endforeach
    </tbody>
</table>