<!DOCTYPE html>
<html>
<head>
    <title>Records PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .no-records {
            text-align: center;
            padding: 20px;
            font-size: 16px;
        }
        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Filtered Records</h1>
    @if($records->isEmpty())
        <p class="no-records">No records found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Supplier</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Created Date</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalQuantity = 0;
                @endphp
                @foreach($records as $record)
                @php
                    $totalQuantity += $record->quantity;
                @endphp
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->supplier ? $record->supplier->name : 'N/A' }}</td>
                    <td>{{ $record->category ? $record->category->name : 'N/A' }}</td>
                    <td>{{ $record->product ? $record->product->name : 'N/A' }}</td>
                    <td>{{ $record->quantity }}</td>
                    <td>{{ $record->created_at ? $record->created_at->format('Y-m-d') : 'N/A' }}</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="4">Total</td>
                    <td>{{ $totalQuantity }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    @endif
</body>
</html>
