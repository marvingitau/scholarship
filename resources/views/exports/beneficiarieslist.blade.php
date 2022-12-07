<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Unique ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Institution</th>
            <th>School</th>
            <th>Disability</th>
            <th>Other Sponsor</th>
        </tr>
    </thead>
    <tbody>
        @foreach($slip as $key=>$item)
        <tr>
            <td>{{ ++$key }}</td>
            <td>{{ $item->id }}</td>
            <td>{{ $item->firstname }} {{ $item->lastname }}</td>
            <td>{{ $item->age }}</td>
            <td>{{ $item->MobileActive }}</td>
            <td>{{$item->EmailActive}}</td>
            <td>{{ $item->Type }}</td>
            <td>{{ $item->SecondaryAdmitted }}</td>
            <td>{{ $item->TypeofDisability }}</td>
            <td>{{ $item->AnotherSponsorship  }}</td>
        </tr>
        @endforeach
    </tbody>
</table>