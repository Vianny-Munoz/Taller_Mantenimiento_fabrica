<!DOCTYPE html>
<html lang="es">
   <head>
       <!-- Configuración de caracteres y responsividad -->
       <meta charset="utf-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <title></title>
       <meta name="description" content="">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
       <link rel="stylesheet" href="estilos.css">

   </head>
   <body>
           
       
   <main>
       
       <!-- login -->
       <section class = "Login-section" id="Login">
           <div class = "login-container">
               <div class = "login-image">
                   <img src="imagenes/img_login.png" alt="Imagen de login">
               </div>
               

               <!----formulario de INICIAR SESION-->
               <div class = "login-form form-login">
                   <h2>Bienvenido!</h2>
                
                   <form action="login.php   " method="POST">

                       <input type="text" placeholder="Usuario" name="usuario" required>
                       <input type="password" placeholder="Contraseña" name="password" required>
                       <button type="submit" class="login-btn">Iniciar Sesión</button>
                       <div class="login-options">
                           <label>
                               <input type="checkbox" name="remember">Recuérdame </label>
                               <a href="#">¿Olvidaste tu contraseña?</a>
                       </div>

                       <div class="login-footer">
                           <p>¿No tienes cuenta? <a href="#" id = "show-register">Regístrate</a></p>
                       </div>

                   </form>
               </div>
               <!-- Registrarse-->
               <div class="login-form form-register hidden">
                   <h2> Crear cuenta</h2>
                   <form action="agregar_registro.php" method="POST">
                   <!-- <form action="/register" method="POST"> -->
                        <input type="text" placeholder="Cédula" name = "cedula" required>
                        <input type="text" placeholder="Nombres" name = "nombre" required>
                        <input type="text" placeholder="Apellidos" name = "apellido" required>
                        <input type="text" placeholder="Telefono" name = "celular" required>
                        <input type="text" placeholder="Especialidad" name = "especialidad" required>
                        <input type="text" placeholder="Correo Electrónico" name="email" required>
                        <input type="text" placeholder="Usuario" name="usuario" required>
                        <input type="password" placeholder="Contraseña" name="contrasena" required>
                        <button type="submit" class = "login-btn" style = "background-color: green;">Registrarse</button>

                       <div class="login-footer">
                           <p> ¿Ya tienes cuenta? <a href="#" id="show-login">Iniciar Sesión</a> </p>
                       </div>
                   </form>

                </div>

           </div>

       </section>

       <script>
        document.getElementById ('show-register').addEventListener('click', function(e){
            e.preventDefault();
            document.querySelector('.form-login').style.display = 'none';
            document.querySelector('.form-register').style.display = 'block';
        console.log('Formulario de registro visible');
        });

        document.getElementById('show-login').addEventListener('click', function(e){
            e.preventDefault();
            document.querySelector('.form-login').style.display = 'block';
            document.querySelector('.form-register').style.display = 'none';

        });

        document.addEventListener("DOMContentLoaded", function () {
            const showRegister = document.getElementById('show-register');
            const showLogin = document.getElementById('show-login');
            const loginForm = document.querySelector('.form-login');
            const registerForm = document.querySelector('.form-register');
            
            showRegister.addEventListener('click', function (e) {
                e.preventDefault();
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                console.log('Formulario de registro visible');

                // Validación en tiempo real
                [inputCedula, inputCelular].forEach(input => {
                    input.addEventListener('input', function () {
                        this.value = this.value.replace(/\D/g, '');
                    });
                });

            });
            showLogin.addEventListener('click', function (e) {
                e.preventDefault();
                registerForm.classList.add('hidden');
                loginForm.classList.remove('hidden');
                console.log('Formulario de login visible');

            });

        });
       </script>
        
        <script>
        document.addEventListener("DOMContentLoaded", function () {
            const formRegister = document.querySelector('.form-register form');
            const inputCedula = formRegister.querySelector('input[name="cedula"]');
            const inputCelular = formRegister.querySelector('input[name="celular"]');

            // Validación en tiempo real 
            [inputCedula, inputCelular].forEach(input => {
                input.addEventListener('input', function () {
                    this.value = this.value.replace(/\D/g, '');
                });
            });

            // Validaciones al enviar
            formRegister.addEventListener('submit', function(event) {
                const cedula = inputCedula.value.trim();
                const celular = inputCelular.value.trim();
                const email = formRegister.querySelector('input[name="email"]').value.trim();
                const usuario = formRegister.querySelector('input[name="usuario"]').value.trim();
                const contrasena = formRegister.querySelector('input[name="contrasena"]').value.trim();

                let errores = [];

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    errores.push("El correo electrónico no es válido.");
                }

                if (usuario.length < 4) {
                    errores.push("El usuario debe tener al menos 4 caracteres.");
                }

                if (contrasena === cedula || contrasena === celular) {
                    errores.push("La contraseña no puede ser igual a la cédula ni al teléfono.");
                }

                if (errores.length > 0) {
                    alert(errores.join("\n"));
                    event.preventDefault();
                }
            });
        });
        </script>

        <!--para el login-->
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
        }
        ?>
        
        <!--para el registro-->

        <?php
        if (isset($_GET['mensaje']) && $_GET['mensaje'] === 'registro_exitoso') {
            echo "<script>alert('Registro exitoso');</script>";
        }
        if (isset($_GET['error']) && $_GET['error'] === 'cedula_o_usuario_existente') {
            echo "<script>alert('La cédula o el usuario ya están registrados Inicia sesión con tu usuario y contraseña');</script>";
        }
        if (isset($_GET['error']) && $_GET['error'] === 'error_al_guardar') {
            echo "<script>alert('Ocurrió un error al guardar los datos');</script>";
        }
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
        }
        ?>


    </body>
    
    
    </html>