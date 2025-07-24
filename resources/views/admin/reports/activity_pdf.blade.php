<!-- resources/views/admin/reports/activity_pdf.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Aktivitas</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Laporan Aktivitas Pengguna</h2>
    <table>
        <thead>
            <tr>
                <th>ID Aktivitas</th>
                <th>Nama Pengguna</th>
                <th>Deskripsi Aktivitas</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->id }}</td>
                    <td>{{ $activity->user->name }}</td>
                    <td>{{ $activity->description }}</td>
                    <td>{{ $activity->created_at->format('d-m-Y H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>