<table>
    <thead>
        <tr>
            <th>code </th>
            <th>entreprise</th>
            <th>contact</th>
            <th>telephone </th>
            <th>email </th>
            <th style="width: 50px;">addresse</th>
            <th>rc</th>
            <th>ice</th>
            <th>logo</th>
            <th>description</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $client)
            <tr>
                <td>{{ $client->code }}</td>
                <td>{{ $client->entreprise }}</td>
                <td>{{ $client->contact }}</td>
                <td>{{ $client->telephone }}</td>
                <td>{{ $client->email }}</td>
                <td style="width: 50px;">{{ $client->addresse }}</td>
                <td>{{ $client->rc }}</td>
                <td>{{ $client->ice }}</td>
                <td>{{ $client->logo }}</td>
                <td>{{ $client->description }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
