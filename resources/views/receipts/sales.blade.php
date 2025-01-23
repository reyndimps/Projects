<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Order Receipt</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
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
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .header p {
            color: #777;
            font-size: 14px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .table th, .table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .table th {
            background-color: #f1f1f1;
        }
        .total {
            text-align: left;
            font-size: 15px;
            margin-top: 20px;
        }
        .total p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            color: #777;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>Akina Computer Parts and Accessories Shop</h1>
            <p>004 JRC BLDG, McArthur Highway, Davao City, 8000 Davao</p>
            <p>Date: {{ $salesOrder->created_at->format('Y-m-d H:i:s') }}</p>
        </div>

        <!-- Table with Products -->
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->inventory->product->product }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>P{{ number_format($item->price, 2) }}</td>
                        <td>P{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Total Section (Left-aligned) -->
        <div class="total">
            <p><strong>Total Amount:</strong>P{{ number_format($salesOrder->total_amount, 2) }}</p>
            <p><strong>Sales Tax:</strong> P{{ number_format($salesTax, 2) }}</p> <!-- Display Sales Tax -->
            <p><strong>Cash:</strong> P{{ number_format($salesOrder->cash_amount, 2) }}</p>
            <p><strong>Change:</strong> P{{ number_format($salesOrder->change_amount, 2) }}</p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>Thank you for your purchase! Visit again soon.</p>
        </div>
    </div>
</body>
</html>
