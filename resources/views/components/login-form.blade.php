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

        <form action="{{ route('login') }}" method="POST" id="loginForm" novalidate>
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Correo electrónico</label>
                <input id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    type="email" placeholder="usuario@ejemplo.com" value="{{ old('email') }}" required
                    pattern="[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$"
                    autocomplete="email" />
                <div class="invalid-feedback" id="emailError">
                    Por favor ingresa un correo electrónico válido (ejemplo: usuario@dominio.com)
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Contraseña</label>
                <input id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    type="password" placeholder="********" required minlength="6" />
                <div class="invalid-feedback">
                    La contraseña debe tener al menos 6 caracteres
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Iniciar sesión</button>
        </form>

        <div class="text-center mt-4 pt-2 border-top">
            <p class="mb-2 text-muted">¿Aún no tienes cuenta?</p>
            <a href="#" class="btn btn-outline-secondary px-4">Registrarse</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        // Expresión regular para validar email
        const emailRegex = /^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/;

        // Validación en tiempo real del email
        emailInput.addEventListener('input', function() {
            validarEmail(this);
        });

        // Validación al perder el foco
        emailInput.addEventListener('blur', function() {
            validarEmail(this);
        });

        // Validación de contraseña
        passwordInput.addEventListener('input', function() {
            if (this.value.length >= 6) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else if (this.value.length > 0) {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
            } else {
                this.classList.remove('is-invalid', 'is-valid');
            }
        });

        function validarEmail(input) {
            const valor = input.value.trim();

            // Si está vacío, no marcar error (a menos que intente enviar)
            if (valor === '') {
                input.classList.remove('is-invalid', 'is-valid');
                return false;
            }

            // Validar con regex
            if (emailRegex.test(valor)) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                return true;
            } else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
                document.getElementById('emailError').textContent =
                    'Por favor ingresa un correo electrónico válido (ejemplo: usuario@dominio.com)';
                return false;
            }
        }

        // Validar antes de enviar
        form.addEventListener('submit', function(e) {
            let valido = true;

            // Validar email
            if (!validarEmail(emailInput)) {
                valido = false;
                emailInput.focus();
            }

            // Validar contraseña
            if (passwordInput.value.length < 6) {
                passwordInput.classList.add('is-invalid');
                valido = false;
                if (emailRegex.test(emailInput.value)) {
                    passwordInput.focus();
                }
            }

            if (!valido) {
                e.preventDefault();
                e.stopPropagation();
            }
        });
    });
</script>