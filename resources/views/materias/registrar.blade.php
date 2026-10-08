<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registrar materia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand navbar-dark bg-primary mb-4">
    <div class="container">
        <span class="navbar-brand">Materias</span>
        <div class="navbar-nav">
            <a class="nav-link" href="{{ url('/materias') }}">Mostrar</a>
            <a class="nav-link active" href="{{ url('/materias/registrar') }}">Registrar</a>
            <a class="nav-link" href="{{ url('/materias/eliminar') }}">Eliminar</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Registrar materia</h5>
                </div>
                <div class="card-body">
                    <form action="{{ url('/materias') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="clave" class="form-label">Clave</label>
                            <input type="text" class="form-control" id="clave" name="clave"
                                   value="{{ old('clave') }}" placeholder="Ej. MAT101" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la materia</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                   value="{{ old('nombre') }}" placeholder="Ej. Programación Lógica" required>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="creditos" class="form-label">Créditos</label>
                                <input type="number" class="form-control" id="creditos" name="creditos"
                                       value="{{ old('creditos') }}" min="1" max="20" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="semestre" class="form-label">Semestre</label>
                                <select class="form-select" id="semestre" name="semestre" required>
                                    <option value="" selected disabled>Elegir...</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ old('semestre') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ url('/materias') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
