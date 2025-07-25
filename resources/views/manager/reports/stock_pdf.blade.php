<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Stok Produk</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Stok Produk</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok Tersedia</th>
                <th>Stok Minimum</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($product->sale_price, 0, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->minimum_stock }}</td>
                <td>
                    {{ $product->stock < $product->minimum_stock ? 'Di bawah minimum' : 'Aman' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
