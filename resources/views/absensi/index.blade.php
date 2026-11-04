 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Absensi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card-header {
            background-color: #198754;
            color: white;
        }

        .table th, .table td {
            vertical-align: middle;
            font-size: 14px;
        }

        .status-radio {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .status-radio label {
            cursor: pointer;
            font-size: 13px;
        }

        .badge-hadir {
            background-color: #d1fae5;
            color: #059669;
        }

        .badge-absen {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .badge-izin {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-sakit {
            background-color: #dbeafe;
            color: #1d4ed8;
        }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">

    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Data Absensi Mahasiswa</h4>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Filter Tanggal dan Mata Kuliah -->
            <form action="{{ route('absensi.index') }}" method="GET" class="mb-4">
                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tanggal Absensi</label>
                        <input type="date"
                               name="tanggal_absensi"
                               class="form-control"
                               value="{{ $tanggal }}"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Mata Kuliah</label>
                        <select name="matakuliah_id" class="form-select" required>
                            <option value="">-- Pilih Mata Kuliah --</option>

                            @foreach ($matakuliah as $mk)
                                <option value="{{ $mk->id }}"
                                    {{ $matakuliah_id == $mk->id ? 'selected' : '' }}>
                                    {{ $mk->nama_matakuliah }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">
                            Tampilkan Mahasiswa
                        </button>
                    </div>

                </div>
            </form>

            @if ($matakuliah_id)

                <!-- Form Simpan Absensi -->
                <form action="{{ route('absensi.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="tanggal_absensi" value="{{ $tanggal }}">
                    <input type="hidden" name="matakuliah_id" value="{{ $matakuliah_id }}">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">

                            <thead class="table-success">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="35%">Mahasiswa</th>
                                    <th width="20%">Kehadiran</th>
                                    <th width="40%">Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($mahasiswa as $item)

                                    @php
                                        $status = old(
                                            'absensi.' . $item->id,
                                            $absensi->get($item->id)->status_absen ?? ''
                                        );

                                        $statusLabel = [
                                            'H' => 'Hadir',
                                            'A' => 'Absen',
                                            'I' => 'Izin',
                                            'S' => 'Sakit'
                                        ];
                                    @endphp

                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            <strong>{{ $item->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $item->NIM }}</small>
                                        </td>

                                        <td>
                                            @if ($status)
                                                <span class="badge badge-{{ strtolower($statusLabel[$status] ?? '') }}">
                                                    {{ $statusLabel[$status] ?? '-' }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="status-radio">

                                                @foreach (['H' => 'H', 'A' => 'A', 'I' => 'I', 'S' => 'S'] as $value => $label)

                                                    <label>
                                                        <input type="radio"
                                                               name="absensi[{{ $item->id }}]"
                                                               value="{{ $value }}"
                                                               {{ $status == $value ? 'checked' : '' }}
                                                               required>
                                                        {{ $label }}
                                                    </label>

                                                @endforeach

                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            Belum ada data mahasiswa.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                    @if ($mahasiswa->count() > 0)
                        <button type="submit" class="btn btn-success">
                            Simpan Absensi
                        </button>
                    @endif

                </form>

            @else
                <div class="alert alert-info text-center">
                    Silakan pilih tanggal dan mata kuliah terlebih dahulu.
                </div>
            @endif

            <div class="mt-3">
                <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">
                    Kembali ke Mata Kuliah
                </a>
            </div>

        </div>
    </div>

</div>

</body>
</html>
