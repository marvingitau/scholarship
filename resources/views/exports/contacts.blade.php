<table>
    <thead>
        <tr>
            <th>To</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Beneficiary</th>
            <th>School</th>
        </tr>
    </thead>
    <tbody>
        @foreach($slip as $item)
        <tr>
            <td>{{ $item->belongsto }}</td>
            <td>{{ $item->phone }}</td>
            <td>{{$item->email}}</td>
            <td>{{ $item->firstname }} {{ $item->lastname }}</td>
            <td>{{ $item->SecondaryAdmitted }}</td>

        </tr>
        @endforeach
    </tbody>
</table>