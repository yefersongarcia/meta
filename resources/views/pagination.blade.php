<div>
    <table id="id_table" class="table table-bordered">
        <thead>
            <tr>
                <th width="380px">OrcId</th>
                <th width="280px">Names</th>
                <th width="280px">LastNames</th>
                <th width="280px">Keywords</th>
                <th width="100px">Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="id_tbody">
            @foreach ($persons as $person)
                <tr>
                    <td>{{ $person->orc_id }}</td>
                    <td>{{ $person->name }}</td>
                    <td>{{ $person->lastName }}</td>
                    <td>
                        @foreach ($person->keywords as $keyword)
                            <li>{{ $keyword->cont }}</li>
                        @endforeach
                    </td>
                    <td>{{ $person->email }}</td>
                    <td>
                        <button type="submit" class="btn btn-danger" onclick="HandleDelete('{{ $person->orc_id }}')">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    {!! $persons->links() !!}
</div>
