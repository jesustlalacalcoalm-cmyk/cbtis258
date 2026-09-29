
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumnos</title>
    <link rel="icon" type="image/png" href="cbtis 258.jfif">
    <link rel="stylesheet" href="altas1.css">
</head>

<script>
function mostrarFoto(input, id) {
    const imagen = document.getElementById(id);

    if (input.files && input.files[0]) {
        const lector = new FileReader();

        lector.onload = function(e) {
            imagen.src = e.target.result;
        };

        lector.readAsDataURL(input.files[0]);
    }
}
</script>

<body>

<div class="page-shell">

    <div class="content">

        <div class="hero">
            <span class="tag">Control escolar</span>

            <h2>Registro de Alumnos</h2>

            <p class="subtitle">
                Registra los datos del alumno.
            </p>
        </div>

        <div class="form-panel">

            <div class="contenedor">

                <h3>REGISTRAR ALUMNO</h3>

                <div class="linea"></div>

<form action="altas2.php" method="POST" enctype="multipart/form-data">

                    <div class="dato">
                        <label>Matrícula:</label>
                        <input
                            type="text"
                            name="matricula"
                            placeholder="Matrícula"
                            required
                        >
                    </div>

                    <div class="dato">
                        <label>Nombre del alumno:</label>
                        <input
                            type="text"
                            name="nombre_alumno"
                            placeholder="Nombre completo"
                            required
                        >
                    </div>

                    <div class="dato">
                        <label>Semestre y grupo:</label>
                        <input
                            type="text"
                            name="semestre_grupo"
                            placeholder="Ej. 4A"
                            required
                        >
                    </div>

                    <div class="dato">
                        <label>Especialidad:</label>
                        <input
                            type="text"
                            name="especialidad"
                            placeholder="Especialidad"
                            required
                        >
                    </div>

                    <div class="dato">
                        <label>Turno:</label>

                        <select name="turno" required>
                            <option value="">Selecciona un turno</option>
                            <option value="MATUTINO">MATUTINO</option>
                            <option value="VESPERTINO">VESPERTINO</option>
                        </select>
                    </div>

                    <div class="credenciales">

                        <p>
                            CREDENCIAL(ES) DE PERSONA(S) AUTORIZADA(S)
                        </p>

                        <div class="fotos">

                            <div class="credencial">

                                <div class="foto">
                                    <img id="preview1" src="" alt="">

                                    <input
                                        type="file"
                                        name="foto1"
                                        accept="image/*"
                                        onchange="mostrarFoto(this, 'preview1')"
                                    >
                                </div>

                                <input
                                    type="text"
                                    name="autorizado1"
                                    placeholder="Nombre completo"
                                    required
                                >

                            </div>


                            <div class="credencial">

                                <div class="foto">
                                    <img id="preview2" src="" alt="">

                                    <input
                                        type="file"
                                        name="foto2"
                                        accept="image/*"
                                        onchange="mostrarFoto(this, 'preview2')"
                                    >
                                </div>

                                <input
                                    type="text"
                                    name="autorizado2"
                                    placeholder="Nombre completo"
                                >

                            </div>


                            <div class="credencial">

                                <div class="foto">
                                    <img id="preview3" src="" alt="">

                                    <input
                                        type="file"
                                        name="foto3"
                                        accept="image/*"
                                        onchange="mostrarFoto(this, 'preview3')"
                                    >
                                </div>

                                <input
                                    type="text"
                                    name="autorizado3"
                                    placeholder="Nombre completo"
                                >

                            </div>


                            <div class="credencial">

                                <div class="foto">
                                    <img id="preview4" src="" alt="">

                                    <input
                                        type="file"
                                        name="foto4"
                                        accept="image/*"
                                        onchange="mostrarFoto(this, 'preview4')"
                                    >
                                </div>

                                <input
                                    type="text"
                                    name="autorizado4"
                                    placeholder="Nombre completo"
                                >

                            </div>

                        </div>

                    </div>


                    <div class="botones">

                        <button type="submit">
                            DAR DE ALTA
                        </button>

                        <a
                            href="inicio.php"
                            class="btn-volver"
                        >
                            VOLVER AL INICIO
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>
```
s