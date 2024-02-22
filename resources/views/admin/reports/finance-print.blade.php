<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Finance</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            color: #495057;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-heading {
            background-color: #f8f9fa;
            padding: 80px 0;
        }

        .page-heading h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .page-heading p {
            font-size: 1rem;
            margin: 0;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border: 1px solid #dee2e6;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }

        .table th, .table td {
            padding: 0.75rem;
            border: 1px solid #dee2e6;
        }

        th {
            text-align: left;
            color: #495057;
            background-color: #e9ecef;
        }

        h3 {
            font-size: 1.75rem;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-black {
            color: #000 !important;
        }
    </style>
</head>
<body >
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h3 class="my-3"><strong>REPORT FINANCE</strong></h3>
                <p>TOKO MALHEST</p>
            </div>
        </div>
        <hr class="my-2" style="border-width: 5px;">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Sub Total</th>
                    <th>Shipping Cost</th>
                    <th>Grand Total</th>
                    <th>Status Payment</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @isset($financeData)
                @php
                    $total = 0;
                @endphp
                    @forelse ($financeData as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->invoice }}</td>
                            <td>@currency($item->sub_total_transaksi)</td>
                            <td>@currency($item->shipping_cost)</td>
                            <td>@currency($item->grand_total)</td>
                            <td>{{ $item->status_payment}}</td>
                            <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                        </tr>
                    @php
                        $total += $item->grand_total;
                    @endphp
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Data Not found!!</td>
                        </tr>
                    @endforelse
                @endisset
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="font-weight-bold">TOTAL</td>
                    <td colspan="4" class="font-weight-bold">@currency($total)</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <script>
        // Tunggu sampai dokumen selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Mencetak dokumen setelah halaman selesai dimuat
            window.print();
        });
    </script>
</body>
</html>
