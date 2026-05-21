<?php
session_start();
if (!isset($_SESSION['admin_logeado'])) {
    header("Location: login.php");
    exit();
}


$conexion = mysqli_connect("localhost", "root", "", "academia");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}


if (isset($_GET['eliminar'])) {
    $id_eliminar = mysqli_real_escape_string($conexion, $_GET['eliminar']);
    $query_delete = "DELETE FROM cursos WHERE id = '$id_eliminar'";
    
    if (mysqli_query($conexion, $query_delete)) {
        header("Location: nuevo.php?msg=eliminado");
        exit();
    } else {
        $error_msg = "Error al eliminar: " . mysqli_error($conexion);
    }
}


$editando = false;
$curso_edit = [
    'id' => '', 'titulo' => '', 'imagen' => '', 'modalidad_badge' => '', 'modalidad_desc' => '',
    'creditos' => '', 'practicas' => '', 'precio' => '', 'duracion' => '', 'dirigido_a' => '',
    'url_enlace' => '', 'descripcion' => '', 'programa_texto' => ''
];


if (isset($_GET['editar'])) {
    $id_editar = mysqli_real_escape_string($conexion, $_GET['editar']);
    $query_edit = mysqli_query($conexion, "SELECT * FROM cursos WHERE id = '$id_editar'");
    if (mysqli_num_rows($query_edit) > 0) {
        $curso_edit = mysqli_fetch_assoc($query_edit);
        $editando = true; 
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración | MasterMedic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/nuevo.css">
</head>
<body class="bg-light py-5">

    <div class="container" style="max-width: 900px;">
        
        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'eliminado'): ?>
            <div class="alert alert-warning text-center shadow-sm">¡Máster eliminado correctamente de la base de datos!</div>
        <?php endif; ?>
        <?php if (isset($error_msg)): ?>
            <div class="alert alert-danger text-center shadow-sm"><?php echo $error_msg; ?></div>
        <?php endif; ?>

        <div class="bg-white p-4 rounded shadow-sm mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                <h3 class="fw-bold mb-0 text-dark"><i class="bi bi-sliders me-2 text-primary"></i>Listado de Másteres Activos</h3>
                <a href="cursos.php" class="btn btn-sm btn-outline-secondary">Ver Web Pública</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Enlace URL</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $listado = mysqli_query($conexion, "SELECT id, titulo, url_enlace FROM cursos ORDER BY id DESC");
                        if (mysqli_num_rows($listado) > 0) {
                            while ($row = mysqli_fetch_assoc($listado)) {
                                echo "<tr>";
                                echo "<td>{$row['id']}</td>";
                                echo "<td><strong>{$row['titulo']}</strong></td>";
                                echo "<td><code>?tipo={$row['url_enlace']}</code></td>";
                                echo "<td class='text-center'>
                                        <a href='nuevo.php?editar={$row['id']}#formulario' class='btn btn-sm btn-warning me-1 fw-semibold'><i class='bi bi-pencil-square me-1'></i>Modificar</a>
                                        <a href='nuevo.php?eliminar={$row['id']}' class='btn btn-sm btn-danger fw-semibold' onclick='return confirm(\"¿Seguro que quieres borrar este curso?\");'><i class='bi bi-trash me-1'></i>Eliminar</a>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center text-muted py-3'>No hay másteres publicados todavía.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="formulario" class="bg-white p-4 rounded shadow-sm">
            <div class="border-bottom pb-2 mb-4">
                <h3 class="fw-bold mb-0 text-dark">
                    <?php echo $editando ? "<i class='bi bi-pencil-square text-warning me-2'></i>Editar Máster Existente" : "<i class='bi bi-plus-circle text-success me-2'></i>Añadir Nuevo Máster"; ?>
                </h3>
                <?php if($editando): ?>
                    <a href="nuevo.php" class="btn btn-sm btn-link p-0 text-decoration-none">Cancelar edición y crear uno nuevo</a>
                <?php endif; ?>
            </div>
            
            <form method="POST" action="guardar_curso.php<?php echo $editando ? '?id_update=' . $curso_edit['id'] : ''; ?>">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Identificador URL (url_enlace):</label>
                        <input type="text" name="url_enlace" class="form-control" value="<?php echo $curso_edit['url_enlace']; ?>" placeholder="ej: estetica o fisio" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Archivo de Imagen:</label>
                        <input type="text" name="imagen" class="form-control" value="<?php echo $curso_edit['imagen']; ?>" placeholder="ej: estetica.png o fisio.png" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Título Completo del Máster:</label>
                        <input type="text" name="titulo" class="form-control" value="<?php echo $curso_edit['titulo']; ?>" placeholder="ej: Máster en Medicina Estética" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Modalidad (Badge de la tarjeta):</label>
                        <input type="text" name="modalidad_badge" class="form-control" value="<?php echo $curso_edit['modalidad_badge']; ?>" placeholder="ej: Presencial o Online" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Descripción Modalidad (Texto tarjeta):</label>
                        <input type="text" name="modalidad_desc" class="form-control" value="<?php echo $curso_edit['modalidad_desc']; ?>" placeholder="ej: Teórico-Práctico" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Créditos ECTS:</label>
                        <input type="text" name="creditos" class="form-control" value="<?php echo $curso_edit['creditos']; ?>" placeholder="ej: 60 créditos ECTS" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Prácticas:</label>
                        <input type="text" name="practicas" class="form-control" value="<?php echo $curso_edit['practicas']; ?>" placeholder="ej: Centros especializados" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Duración:</label>
                        <input type="text" name="duracion" class="form-control" value="<?php echo $curso_edit['duracion']; ?>" placeholder="ej: 12 meses" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Dirigido a:</label>
                        <input type="text" name="dirigido_a" class="form-control" value="<?php echo $curso_edit['dirigido_a']; ?>" placeholder="ej: Profesionales sanitarios" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Inversión / Precio:</label>
                        <input type="text" name="precio" class="form-control" value="<?php echo $curso_edit['precio']; ?>" placeholder="ej: 9.999€" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Descripción del Máster (Párrafos explicativos):</label>
                        <textarea name="descripcion" class="form-control" rows="5" placeholder="Escribe aquí toda la descripción detallada..." required><?php echo $curso_edit['descripcion']; ?></textarea>
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label fw-semibold">Programa Académico (Módulos):</label>
                        <textarea name="programa_texto" class="form-control" rows="5" placeholder="Módulo 01: ...&#10;Módulo 02: ..." required><?php echo $curso_edit['programa_texto']; ?></textarea>
                    </div>

                    <div class="col-12 mt-4">
                        <?php if($editando): ?>
                            <button type="submit" name="actualizar" class="btn btn-warning btn-lg w-100 fw-bold shadow-sm"><i class="bi bi-check-circle me-2"></i>Guardar Cambios del Máster</button>
                        <?php else: ?>
                            <button type="submit" name="guardar" class="btn btn-success btn-lg w-100 fw-bold shadow-sm"><i class="bi bi-plus-circle me-2"></i>Publicar Nuevo Máster</button>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>