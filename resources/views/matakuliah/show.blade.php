
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mata Kuliah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Detail Mata Kuliah</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <tr>
                    <th width="30%">ID</th>
                    <td>{{ $matakuliah->id }}</td>
                </tr>
                <tr>
                    <th>Kode Mata Kuliah</th>
                    <td>{{ $matakuliah->kode }}</td>
                </tr>
                <tr>
                    <th>Nama Mata Kuliah</th>
                    <td>{{ $matakuliah->nama_matakuliah }}</td>
                </tr>
                <tr>
                    <th>Dibuat</th>
                    <td>{{ $matakuliah->created_at }}</td>
                </tr>
                <tr>
                    <th>Diperbarui</th>
                    <td>{{ $matakuliah->updated_at }}</td>
                </tr>
            </table>

            <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">
                Kembali
            </a>

            <a href="{{ route('matakuliah.edit', $matakuliah->id) }}" class="btn btn-warning">
                Edit
            </a>

        </div>
    </div>
</div>

</body>
</html>
