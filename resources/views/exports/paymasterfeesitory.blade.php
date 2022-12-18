<table>
    <thead>
    <tr>
        <th>BENEFICIARY NO</th>
        <th>BENEFICIARY NAME</th>
        <th>YEAR</th>
        <th>EXPECTED TERM1</th>
        <th>EXPECTED TERM2</th>
        <th>EXPECTED TERM3</th>
        <th>ALLOCATED</th>
        <th>TERM1</th>
        <th>TERM2</th>
        <th>TERM3</th>
    
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item->beneficiary_id }}</td>
            <td>{{ $item->beneficiary }}</td>
            <td>{{ $item->year }}</td>
            <td>{{ $item->expectedterm1 }}</td>
            <td>{{ $item->expectedterm2 }}</td>
            <td>{{ $item->expectedterm3 }}</td>
            <td>{{ $item->AllocatedYealyFee }}</td>
            <td>{{ $item->term1 }}</td>
            <td>{{ $item->term2 }}</td>
            <td>{{ $item->term3 }}</td>
        </tr>
    @endforeach
    </tbody>
</table>