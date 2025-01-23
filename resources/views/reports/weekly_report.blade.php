<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly Inventory and Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        .container {
            width: 80%;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        h3 {
            margin-top: 30px;
            font-size: 18px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

    <div class="container">

        <h1>Weekly Inventory and Sales Report</h1>

        <p><strong>Period:</strong> {{ $startOfWeek }} to {{ $endOfWeek }}</p>

        <h3>Inventory Added This Week</h3>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity Added</th>
                    <th>Price</th>
                    <th>Date Added</th>
                    <th>Expiration Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weeklyInventory as $inventory)
                    <tr>
                        <td>{{ $inventory->product->product }}</td>
                        <td>{{ $inventory->quantity }}</td>
                        <td>{{ number_format($inventory->price, 2) }}</td>
                        <td>{{ $inventory->date_added->format('F j, Y') }}</td>
                        <td>{{ $inventory->expiration_date->format('F j, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Sales Orders This Week</h3>
        <table>
            <thead>
                <tr>
                    <th>Total Amount</th>
                    <th>Sales Tax</th>
                    <th>Cash Amount</th>
                    <th>Change</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weeklySales as $sale)
                    <tr>
                        <td>{{ number_format($sale->total_amount, 2) }}</td>
                        <td>{{ number_format($sale->sales_tax, 2) }}</td>
                        <td>{{ number_format($sale->cash_amount, 2) }}</td>
                        <td>{{ number_format($sale->change_amount, 2) }}</td>
                        <td>{{ $sale->created_at->format('F j, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
