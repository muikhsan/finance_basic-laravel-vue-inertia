<html>

<head>
    <title>Laporan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

    </style>
    <center>
        <h5>Laporan Transaksi</h5>
    </center>
	<table>
		<tr>
			<td>Saldo</td>
			<td>:</td>
			<td>{{ $total_masuk - $total_keluar }}</td>
		</tr>
		<tr>
			<td>Total Masuk</td>
			<td>:</td>
			<td>{{ $total_masuk }}</td>
		</tr>
		<tr>
			<td>Total Keluar</td>
			<td>:</td>
			<td>{{ $total_keluar }}</td>
		</tr>
	</table>
	
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th class="px-4 py-2">No</th>
                <th class="px-4 py-2">Jenis Transaksi</th>
                <th class="px-4 py-2">Tanggal Transaksi</th>
                <th class="px-4 py-2">Nominal Transaksi</th>
                <th class="px-4 py-2">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($transaksi as $t)
            <tr>
                <td class="px-4 py-2">{{ $i++ }}</td>

                @if($t->jenis_transaksi == 'm')
                <td class="px-4 py-2 text-green-600">Masuk</td>
                @else
                <td class="px-4 py-2 text-red-600">Keluar</td>
                @endif
                <td class="px-4 py-2">{{$t->tanggal_transaksi}}</td>

                @if($t->jenis_transaksi == 'm')
                <td class="px-4 py-2 text-green-600">+ {{ $t->nominal_transaksi }}</td>
                @else
                <td class="px-4 py-2 text-red-600">- {{ $t->nominal_transaksi }}</td>
                @endif
                <td>{{$t->deskripsi}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
