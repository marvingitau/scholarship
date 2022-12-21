<table>
    <thead>
    <tr>
        <th>BANK NAME</th>
        <th>BRANCH</th>
        <th>BANK CODE</th>
        <th>A/C NO</th>
        <th>BENEFICIARY</th>
        <th>AMOUNT</th>
        <th>NARRATIVE</th>
        <th>SWIFT</th>
    </tr>
    </thead>
    <tbody>
    @foreach($slip as $item)
        <tr>
            <td>{{ $item->bankname }}</td>
            <td>{{ $item->branch }}</td>
            <td>{{ $item->bankcode }}</td>
            <td>{{$item->accountno}}</td>
            <td>{{ $item->school }}</td>
            <td><?php echo is_null($item->term1)?(is_null($item->term2)?$item->term3:$item->term2):$item->term1 ?></td>
            <td>{{ $item->admissionno }}</td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>