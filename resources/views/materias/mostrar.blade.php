<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Materias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand navbar-dark bg-primary mb-4">
    <div class="container">
        <span class="navbar-brand">Materias</span>
        <div class="navbar-nav">
            <a class="nav-link active" href="{{ url('/materias') }}">Mostrar</a>
            <a class="nav-link" href="{{ url('/materias/registrar') }}">Registrar</a>
        </div>
    </div>
</nav>

<div class="container">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Lista de materias</h4>
        <a href="{{ url('/materias/registrar') }}" class="btn btn-primary">+ Nueva materia</a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Clave</th>
                        <th>Nombre</th>
                        <th>Créditos</th>
                        <th>Semestre</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($materias as $materia)
                        <tr>
                            <td>{{ $materia->id }}</td>
                            <td>{{ $materia->clave }}</td>
                            <td>{{ $materia->nombre }}</td>
                            <td>{{ $materia->creditos }}</td>
                            <td>{{ $materia->semestre }}</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal" data-bs-target="#modalEliminar"
                                        data-id="{{ $materia->id }}"
                                        data-nombre="{{ $materia->nombre }}">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No hay materias registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar -->
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formEliminar" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar materia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    ¿Seguro que quieres eliminar <strong id="nombreMateria"></strong>?
                    Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Pasa el id y el nombre de la materia al modal antes de abrirlo
    document.getElementById('modalEliminar').addEventListener('show.bs.modal', function (event) {
        const boton = event.relatedTarget;
        const id = boton.getAttribute('data-id');
        const nombre = boton.getAttribute('data-nombre');

        document.getElementById('nombreMateria').textContent = nombre;
        document.getElementById('formEliminar').action = "{{ url('/materias') }}/" + id;
    });
</script>
</body>
</html>
