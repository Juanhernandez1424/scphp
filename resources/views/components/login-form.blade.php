<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <h2 class="card-title mb-4 text-center fw-bold">Bienvenido a SmartClean</h2>
        <p class="text-muted text-center mb-4">Ingresa tus datos para iniciar sesión o registrarte.</p>

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Correo electrónico</label>
                <input id="email" name="email" class="form-control" type="email" placeholder="usuario@ejemplo.com"
                    value="{{ old('email') }}" required />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Contraseña</label>
                <input id="password" name="password" class="form-control" type="password" placeholder="********"
                    required />
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Iniciar sesión</button>
        </form>

        <div class="text-center mt-4 pt-2 border-top">
            <p class="mb-2 text-muted">¿Aún no tienes cuenta?</p>
            <a href="#" class="btn btn-outline-secondary px-4">Registrarse</a>
        </div>
    </div>
</div>
