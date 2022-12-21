<table>
    <thead>
    <tr>
        <th>BENEFICIARY NO</th>
        <th>BENEFICIARY NAME</th>
        <th>AGE</th>
        <th>SCHOOL</th>
        <th>TELEPHONE</th>
        <th>TYPE</th>
        <th>YEAR</th>
       
    
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->lastname }}{{ $item->firstname }}</td>
            <td>{{ $item->age }}</td>
            <td>{{ $item->SecondaryAdmitted }}</td>
            <td>{{ $item->MobileActive }}</td>
            <td>{{ $item->Type }}</td>
            <td>{{ $item->year }}</td>
    
        </tr>
    @endforeach
    </tbody>
</table>