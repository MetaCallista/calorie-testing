<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kalkulator Kalori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            padding: 1rem;
        }
        .card {
            max-width: 580px;
            margin: auto;
            border-radius: 1rem;
            border: none;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .btn-clear {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            color: #6c757d;
            transition: all 0.2s ease;
        }
        .btn-clear:hover {
            background-color: #e9ecef;
            color: #495057;
            border-color: #ced4da;
        }
        .form-control:focus, .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }
        .result-box {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-left: 4px solid #2196f3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card shadow p-4">
        <div class="text-center mb-4">
            <i class="fas fa-calculator text-primary mb-3" style="font-size: 2.5rem;"></i>
            <h2 class="fw-bold text-primary">Hitung Kalori Harian Anda</h2>
            <p class="text-muted">Isi data berikut untuk mengetahui kebutuhan kalori harian Anda</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('calculate') }}" id="calorieForm" novalidate>
            @csrf
            <div class="mb-3">
                <label for="gender" class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                <select id="gender" name="gender" class="form-select" required>
                    <option value="" disabled {{ old('gender', $input['gender'] ?? '') === '' ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                    <option value="male" {{ old('gender', $input['gender'] ?? '') === 'male' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="female" {{ old('gender', $input['gender'] ?? '') === 'female' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="weight" class="form-label fw-semibold">Berat Badan (kg) <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input id="weight" type="number" min="20" name="weight" class="form-control" 
                           value="{{ old('weight', $input['weight'] ?? '') }}" placeholder="Contoh: 65" required />
                    <span class="input-group-text">kg</span>
                </div>
            </div>

            <div class="mb-3">
                <label for="height" class="form-label fw-semibold">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input id="height" type="number" min="50" name="height" class="form-control" 
                           value="{{ old('height', $input['height'] ?? '') }}" placeholder="Contoh: 170" required />
                    <span class="input-group-text">cm</span>
                </div>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label fw-semibold">Usia (tahun) <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input id="age" type="number" min="1" name="age" class="form-control" 
                           value="{{ old('age', $input['age'] ?? '') }}" placeholder="Contoh: 25" required />
                    <span class="input-group-text">tahun</span>
                </div>
            </div>

            <div class="d-flex gap-3 mt-4">
                <button type="submit" class="btn btn-primary flex-grow-1 py-2">
                    <i class="fas fa-calculator me-2"></i> Hitung Kalori
                </button>
                <button type="button" id="btnClear" class="btn btn-clear flex-grow-1 py-2">
                    <i class="fas fa-eraser me-2"></i> Clear
                </button>
            </div>
        </form>

        @isset($calories)
            <div class="alert result-box mt-4 p-3 text-center fs-5 fw-semibold rounded-3">
                <i class="fas fa-fire-alt text-primary me-2"></i>
                Kebutuhan Kalori Harian Anda: 
                <span class="text-primary fw-bold">{{ $calories }} kcal</span>
            </div>
        @endisset
    </div>
</div>

<script>
    document.getElementById('btnClear').addEventListener('click', function() {
        window.location.href = "{{ route('form') }}";
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
