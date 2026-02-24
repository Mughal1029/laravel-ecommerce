<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $data->id }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-size: 14px;
        }
        .invoice-box {
            max-width: 900px;
            margin: auto;
            padding: 30px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

<div class="invoice-box">

    <!-- Header -->
    <div class="row mb-4">
        <div class="col-6">
            <h4>Your Store Name</h4>
            <p class="mb-0">yourstore@email.com</p>
            <p class="mb-0">0300-0000000</p>
        </div>
        <div class="col-6 text-end">
            <h6>Invoice</h6>
            <p class="mb-0"><strong>Invoice #:</strong> {{ $data->id }}</p>
            <p class="mb-0"><strong>Date:</strong> {{ $data->created_at->format('d-m-Y') }}</p>
        </div>
    </div>

    <hr>

    <!-- Customer -->
    <div class="mb-4">
        <h6>Bill To:</h6>
        <p class="mb-1"><strong>Name:</strong> {{ $data->user->name ?? 'N/A' }}</p>
        <p class="mb-1"><strong>Email:</strong> {{ $data->user->email ?? 'N/A' }}</p>
    </div>

    <!-- Product Table -->
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Product</th>
                <th class="text-center">Qty</th>
                <th class="text-end">Price</th>
                <th class="text-end">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>

                <td>
                    {{ $data->product?->product_title ?? 'Product Deleted' }}
                </td>

                <td class="text-center">
                    {{ $data->product_quantity }}
                </td>

                <td class="text-end">
                    {{ number_format((float)$data->product_price, 2) }}
                </td>

                <td class="text-end">
                    {{ number_format((float)$data->product_price * 
                        (int)$data->product_quantity, 2) }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Totals -->
    <div class="row justify-content-end">
        <div class="col-5">
            <table class="table">
                <tr>
                    <th>Subtotal</th>
                    <td class="text-end">
                        {{ number_format($data->product_price * $data->product_quantity, 2) }}
                    </td>
                </tr>
                <tr>
                    <th>Shipping</th>
                    <td class="text-end">
                        {{ number_format($data->shipping ?? 0, 2) }}
                    </td>
                </tr>
                <tr>
                    <th>Grand Total</th>
                    <td class="text-end fw-bold">
                        {{ number_format($data->total ?? ($data->product_price * $data->product_quantity), 2) }}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <p class="text-center mt-4">
        Thank you for shopping with us!
    </p>

</div>

</body>
</html>