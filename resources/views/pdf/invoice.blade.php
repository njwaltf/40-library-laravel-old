<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .invoice {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .invoice-header,
        .invoice-footer {
            background-color: #6777ef;
            color: #fff;
            padding: 10px;
            text-align: center;
            width: 100%;
        }

        .invoice-body {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            padding: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #6777ef;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #6777ef;
            color: #fff;
        }

        .qr-code-container {
            flex: 1;
            border: 2px solid #6777ef;
            padding: 10px;
            margin-right: 20px;
            text-align: center;
        }

        .qr-code-container img {
            max-width: 100%;
            height: 250px;
            display: block;
            margin: 0 auto;
            /* Center the image */
        }
    </style>
</head>

<body>
    <div class="invoice">
        <div class="invoice-header">
            <h2>Invoice</h2>
        </div>

        <div class="invoice-body">
            @foreach ($booking as $item)
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Judul Buku</td>
                            <td>{{ $item->book->title }}</td>
                        </tr>

                        <tr>
                            <td>Jumlah</td>
                            <td>1</td>
                        </tr>

                        <tr>
                            <td>Nama Peminjam</td>
                            <td>{{ $item->user->name }}</td>
                        </tr>

                        <tr>
                            <td>Tanggal Peminjaman</td>
                            <td>{{ date('d-m-Y', strtotime($item->book_at)) }}</td>
                        </tr>

                        <tr>
                            <td>Email Pengguna:</td>
                            <td>{{ $item->user->email }}</td>
                        </tr>
                        <tr>
                            <td>Kode Peminjaman</td>
                            <td><strong>{{ $item->booking_code }}</strong></td>
                        </tr>

                        <!-- Add more details as needed -->

                    </tbody>
                </table>

                <div class="qr-code-container">
                    <!-- Your QR code image -->
                    <img src="data:image/png;base64, {!! base64_encode(
                        QrCode::size(100)->generate('http://127.0.0.1:8000/bookings-management/' . $item->id . '/edit'),
                    ) !!} " alt="QR Code">
                </div>
            @endforeach
        </div>

        <div class="invoice-footer">
            <p>Berikan invoice ini ke admin atau pustakawan</p>
        </div>
    </div>
</body>

</html>
