<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Eliminar materia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand navbar-dark bg-primary mb-4">
    <div class="container">
        <span class="navbar-brand">Materias</span>
        <div class="navbar-nav">
            <a class="nav-link" href="{{ url('/materias') }}">Mostrar</a>
            <a class="nav-link" href="{{ url('/materias/registrar') }}">Registrar</a>
            <a class="nav-link active" href="{{ url('/materias/eliminar') }}">Eliminar</a>
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

            <div class="card shadow-sm border-danger">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Eliminar materia</h5>
                </div>
                <div class="card-body">
                    <form id="formEliminar" method="POST" action="">
                        @csrf
                        @method('DELETE')

                        <div class="mb-3">
                            <label for="materia_id" class="form-label">Selecciona la materia</label>
                            <select class="form-select" id="materia_id" required>
                                <option value="" selected disabled>Elegir...</option>
                                @foreach ($materias as $materia)
                                    <option value="{{ $materia->id }}">
                                        {{ $materia->clave }} - {{ $materia->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="alert alert-warning small">
                            Al eliminar la materia no podrás recuperarla.
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ url('/materias') }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('¿Seguro que quieres eliminar esta materia?')">
                                Eliminar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Ajusta la ruta del formulario según la materia elegida: /materias/{id}
    document.getElementById('materia_id').addEventListener('change', function () {
        document.getElementById('formEliminar').action = "{{ url('/materias') }}/" + this.value;
    });
</script>
</body>
</html>
