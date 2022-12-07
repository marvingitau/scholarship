<table>
    <thead>
    <tr>
        <th>BANK CODE</th>
        <th>BRANCH CODE</th>
        <th>A/C NO</th>
        <th>BANK NAME</th>
        <th>BENEFICIARY</th>
        <th>AMOUNT</th>
        <th>SWIFT</th>
        <th>NARRATIVE</th>
    </tr>
    </thead>
    <tbody>
    @foreach($slip as $item)
        <tr>
            <td>{{ $item->bankcode }}</td>
            <td>{{ $item->branch }}</td>
            <td>{{$item->accountno}}</td>
            <td>{{ $item->bankname }}</td>
            <td>{{ $item->school }}</td>
            <td><?php echo is_null($item->term1)?(is_null($item->term2)?$item->term3:$item->term2):$item->term1 ?></td>
            <td></td>
            <td>{{ $item->admissionno }}</td>
        </tr>
    @endforeach
    </tbody>
</table>