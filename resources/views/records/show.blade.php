<table class="table mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Supplier</th>
            <th>Category</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Created Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->supplier ? $record->supplier->name : 'N/A' }}</td>
            <td>{{ $record->category ? $record->category->name : 'N/A' }}</td>
            <td>{{ $record->product ? $record->product->name : 'N/A' }}</td>
            <td>{{ $record->quantity }}</td>
            <td>{{ $record->created_at ? $record->created_at->format('Y-m-d') : 'N/A' }}</td>
            <td>
                <a href="{{ route('records.show', $record->id) }}" class="btn btn-info">View Record</a>
                <a href="{{ url('records/'.$record->id.'/edit') }}" class="btn btn-warning">Edit</a>
                <form action="{{ url('records/'.$record->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
