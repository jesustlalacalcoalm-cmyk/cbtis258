<?php
session_start();

if (empty($_SESSION['token_bajas'])) {
    $_SESSION['token_bajas'] = bin2hex(random_bytes(32));
}

$conexion = mysqli_connect('localhost', 'root', '', 'justificantes');
$error = '';
$mensaje = '';
$alumnos = [];
$criterios = null;
$semestre = '';
$grupo = '';
$especialidad = '';
$especialidadesDisponibles = [
    'Mecanica',
    'programacion',
    'Alimentos y Bebidas',
    'contabilidad',
    'hospedaje',
    'logistica',
    'ciberseguridad',
    'inteligencia artificial'
];

if (!$conexion) {
    $error = 'No se pudo conectar con la base de datos.';
} else {
    mysqli_set_charset($conexion, 'utf8mb4');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['token'] ?? '';

        if (!hash_equals($_SESSION['token_bajas'], $token)) {
            $error = 'La sesión expiró. Recarga la página e inténtalo de nuevo.';
        } else {
            $accion = $_POST['accion'] ?? '';
            $semestre = trim($_POST['semestre'] ?? '');
            $grupo = strtoupper(trim($_POST['grupo'] ?? ''));
            $especialidad = trim($_POST['especialidad'] ?? '');

            if (!preg_match('/^[1-6]$/', $semestre)) {
                $error = 'Selecciona un semestre válido.';
            } elseif (!preg_match('/^[A-Z]$/', $grupo)) {
                $error = 'Escribe una sola letra válida para el grupo.';
            } elseif (!in_array($especialidad, $especialidadesDisponibles, true)) {
                $error = 'Selecciona una especialidad válida.';
            } else {
                $semestreGrupo = $semestre . $grupo;
                $criterios = [
                    'semestre' => $semestre,
                    'grupo' => $grupo,
                    'especialidad' => $especialidad,
                    'semestre_grupo' => $semestreGrupo
                ];

                if ($accion === 'buscar') {
                    $consulta = mysqli_prepare(
                        $conexion,
                        'SELECT matricula, nombre_alumno
                         FROM salidas
                         WHERE semestre_grupo = ? AND especialidad = ?
                         ORDER BY nombre_alumno ASC'
                    );

                    if ($consulta) {
                        mysqli_stmt_bind_param($consulta, 'ss', $semestreGrupo, $especialidad);

                        if (mysqli_stmt_execute($consulta)) {
                            $resultado = mysqli_stmt_get_result($consulta);
                            while ($alumno = mysqli_fetch_assoc($resultado)) {
                                $alumnos[] = $alumno;
                            }

                            if (count($alumnos) === 0) {
                                $mensaje = 'No se encontraron alumnos con esos criterios.';
                            }
                        } else {
                            $error = 'No se pudo consultar el grupo.';
                        }

                        mysqli_stmt_close($consulta);
                    } else {
                        $error = 'No se pudo preparar la búsqueda.';
                    }
                } elseif ($accion === 'eliminar') {
                    if (($_POST['confirmacion'] ?? '') !== 'confirmar') {
                        $error = 'Debes confirmar que deseas eliminar todo el grupo.';
                    } else {
                        mysqli_begin_transaction($conexion);
                        $consulta = mysqli_prepare(
                            $conexion,
                            'DELETE FROM salidas
                             WHERE semestre_grupo = ? AND especialidad = ?'
                        );

                        if ($consulta) {
                            mysqli_stmt_bind_param($consulta, 'ss', $semestreGrupo, $especialidad);

                            if (mysqli_stmt_execute($consulta)) {
                                $cantidad = mysqli_stmt_affected_rows($consulta);
                                mysqli_commit($conexion);
                                $mensaje = "Se eliminaron permanentemente {$cantidad} alumno(s) del grupo {$semestreGrupo} de {$especialidad}.";
                            } else {
                                mysqli_rollback($conexion);
                                $error = 'No se pudo eliminar el grupo.';
                            }

                            mysqli_stmt_close($consulta);
                        } else {
                            mysqli_rollback($conexion);
                            $error = 'No se pudo preparar la eliminación.';
                        }
                    }
                } else {
                    $error = 'La acción solicitada no es válida.';
                }
            }
        }
    }

}

function escapar($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baja de Justificante</title>
    <link rel="icon" type="image/png" href="cbtis 258.jfif">
    <link rel="stylesheet" href="bajas.css">
    <style>
        .contenedor {
            width: min(900px, 100%);
            min-height: 0;
        }

        .filtros {
            display: grid;
            grid-template-columns: 1fr 1fr 2fr;
            gap: 16px;
        }

        .filtros .dato,
        .resultado,
        .advertencia {
            width: 100%;
        }

        .filtros select,
        .filtros input {
            width: 100%;
            height: 45px;
            padding: 8px 12px;
            border: 2px solid transparent;
            border-radius: 10px;
            background: white;
            color: #333;
            font: inherit;
        }

        .botones {
            position: static;
            width: 100%;
            flex-direction: row;
            margin-top: 20px;
        }

        .botones button {
            flex: 1;
        }

        .botones a {
            display: block;
            padding: 8px 15px;
            color: white;
            text-align: center;
            text-decoration: none;
        }

        .resultado-lista {
            max-height: 300px;
            overflow-y: auto;
        }

        .resultado-lista p {
            padding-bottom: 8px;
            border-bottom: 1px solid #ddd;
        }

        .confirmacion {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 18px 0;
            color: white;
            line-height: 1.5;
        }

        .confirmacion input {
            margin-top: 4px;
        }

        .aviso-error {
            color: #fff;
            background: rgba(130, 0, 0, 0.72);
        }

        .aviso-exito {
            color: #fff;
            background: rgba(0, 90, 45, 0.72);
        }

        @media (max-width: 650px) {
            .filtros {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .botones {
                position: static;
                flex-direction: column;
            }
        }
    </style>
</head>

<body background="cobrafondo.png">

<div class="contenedor">

    <h1>BAJA DE ALUMNOS POR GRUPO</h1>

    <div class="linea"></div>

    <?php if ($error !== '') { ?>
        <div class="advertencia aviso-error"><p><?php echo escapar($error); ?></p></div>
    <?php } ?>

    <?php if ($mensaje !== '') { ?>
        <div class="advertencia aviso-exito"><p><?php echo escapar($mensaje); ?></p></div>
    <?php } ?>

    <?php if (isset($conexion) && $conexion) { ?>
        <form method="POST" action="bajas.php">
            <input type="hidden" name="token" value="<?php echo escapar($_SESSION['token_bajas']); ?>">
            <input type="hidden" name="accion" value="buscar">

            <div class="filtros">
                <div class="dato">
                    <label for="semestre">SEMESTRE</label>
                    <select id="semestre" name="semestre" required>
                        <option value="">Selecciona</option>
                        <?php for ($numeroSemestre = 1; $numeroSemestre <= 6; $numeroSemestre++) { ?>
                            <option value="<?php echo $numeroSemestre; ?>" <?php echo $semestre === (string) $numeroSemestre ? 'selected' : ''; ?>>
                                <?php echo $numeroSemestre; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="dato">
                    <label for="grupo">GRUPO</label>
                    <input id="grupo" name="grupo" type="text" maxlength="1" pattern="[A-Za-z]" placeholder="Ej. A" value="<?php echo escapar($grupo); ?>" required>
                </div>

                <div class="dato">
                    <label for="especialidad">ESPECIALIDAD</label>
                    <select id="especialidad" name="especialidad" required>
                        <option value="">Selecciona una especialidad</option>
                        <?php foreach ($especialidadesDisponibles as $opcionEspecialidad) { ?>
                            <option value="<?php echo escapar($opcionEspecialidad); ?>" <?php echo $especialidad === $opcionEspecialidad ? 'selected' : ''; ?>>
                                <?php echo escapar($opcionEspecialidad); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="advertencia">
                <p>Primero se mostrará la lista de alumnos coincidentes. La eliminación será permanente.</p>
            </div>

            <div class="botones">
                <button type="submit">BUSCAR GRUPO</button>
                <button type="button"><a href="Inicio.php">VOLVER AL INICIO</a></button>
            </div>
        </form>
    <?php } ?>

    <?php if ($criterios !== null && count($alumnos) > 0 && $error === '') { ?>
        <section class="resultado-lista" aria-live="polite">
            <h2>Alumnos encontrados: <?php echo count($alumnos); ?></h2>
            <div class="resultado">
                <?php foreach ($alumnos as $alumno) { ?>
                    <p><?php echo escapar($alumno['nombre_alumno']); ?> · Matrícula: <?php echo escapar($alumno['matricula']); ?></p>
                <?php } ?>
            </div>
            <div class="advertencia">
                <p>Se eliminarán todos los registros del semestre <?php echo escapar($criterios['semestre']); ?>, grupo <?php echo escapar($criterios['grupo']); ?>, especialidad <?php echo escapar($criterios['especialidad']); ?>.</p>
            </div>
            <form method="POST" action="bajas.php" onsubmit="return confirm('Esta acción eliminará permanentemente a todos los alumnos del grupo. ¿Deseas continuar?');">
                <input type="hidden" name="token" value="<?php echo escapar($_SESSION['token_bajas']); ?>">
                <input type="hidden" name="accion" value="eliminar">
                <input type="hidden" name="semestre" value="<?php echo escapar($criterios['semestre']); ?>">
                <input type="hidden" name="grupo" value="<?php echo escapar($criterios['grupo']); ?>">
                <input type="hidden" name="especialidad" value="<?php echo escapar($criterios['especialidad']); ?>">
                <label class="confirmacion">
                    <input type="checkbox" name="confirmacion" value="confirmar" required>
                    Confirmo que deseo eliminar permanentemente a todos los alumnos mostrados.
                </label>
                <div class="botones">
                    <button type="submit">ELIMINAR GRUPO COMPLETO</button>
                </div>
            </form>
        </section>
    <?php } ?>
</div>

</body>
</html>
