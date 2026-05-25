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
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill fs-5 me-2 text-success"></i>
                <div>¡Máster eliminado correctamente de la base de datos!</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (isset($error_msg)): ?>
            <div class="alert alert-danger text-center shadow-sm"><?php echo $error_msg; ?></div>
        <?php endif; ?>

        <!-- LISTADO DE MÁSTERES ACTIVOS -->
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
                                        <button type='button' class='btn btn-sm btn-danger fw-semibold' 
                                            onclick='confirmarEliminar({$row['id']}, \"" . addslashes($row['titulo']) . "\")'>
                                            <i class='bi bi-trash me-1'></i>Eliminar
                                        </button>
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

        <!-- FORMULARIO -->
        <div id="formulario" class="bg-white p-4 rounded shadow-sm">
            <div class="border-bottom pb-2 mb-4">
                <h3 class="fw-bold mb-0 text-dark">
                    <?php echo $editando ? "<i class='bi bi-pencil-square text-warning me-2'></i>Editar Máster Existente" : "<i class='bi bi-plus-circle text-success me-2'></i>Añadir Nuevo Máster"; ?>
                </h3>
                <?php if($editando): ?>
                    <a href="nuevo.php" class="btn btn-sm btn-link p-0 text-decoration-none">Cancelar edición y crear uno nuevo</a>
                <?php endif; ?>
            </div>
            
            <?php if (isset($_GET['error']) && $_GET['error'] === 'repetido'): ?>
                <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                    <div>
                        <strong>¡Atención!</strong> Ya existe un Máster registrado con ese mismo título. Por favor, verifica los datos e inténtalo de nuevo con un nombre diferente.
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill fs-4 me-3"></i>
                    <div>
                        <strong>¡Excelente!</strong> El Máster se ha guardado y publicado correctamente de manera segura.
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form method="POST" action="guardar_curso.php<?php echo $editando ? '?id_update=' . $curso_edit['id'] : ''; ?>" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Identificador:</label>
                        <input type="text" name="url_enlace" class="form-control" value="<?php echo $curso_edit['url_enlace']; ?>" placeholder="ej: estetica o fisio" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Seleccionar Imagen del Máster:</label>
                        <input type="file" name="imagen" class="form-control" accept="image/*" <?php echo $editando ? '' : 'required'; ?>>
                        
                        <?php if ($editando && !empty($curso_edit['imagen'])): ?>
                            <div class="form-text text-muted">
                                Imagen actual: <strong><?php echo $curso_edit['imagen']; ?></strong> (Selecciona un archivo solo si deseas cambiarla).
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Título Completo del Máster:</label>
                        <input type="text" name="titulo" class="form-control" value="<?php echo $curso_edit['titulo']; ?>" placeholder="ej: Máster en Medicina Estética" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Asistencia:</label>
                        <select name="modalidad_badge" class="form-select" required>
                            <option value="" disabled <?php echo !$editando ? 'selected' : ''; ?>>Selecciona...</option>
                            <option value="Presencial" <?php echo ($editando && $curso_edit['modalidad_badge'] == 'Presencial') ? 'selected' : ''; ?>>Presencial</option>
                            <option value="Online" <?php echo ($editando && $curso_edit['modalidad_badge'] == 'Online') ? 'selected' : ''; ?>>Online</option>
                            <option value="Semipresencial" <?php echo ($editando && $curso_edit['modalidad_badge'] == 'Semipresencial') ? 'selected' : ''; ?>>Semipresencial</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Modalidad:</label>
                        <select name="modalidad_desc" class="form-select" required>
                            <option value="" disabled <?php echo !$editando ? 'selected' : ''; ?>>Selecciona una opción...</option>
                            <option value="Práctico" <?php echo ($editando && $curso_edit['modalidad_desc'] == 'Práctico') ? 'selected' : ''; ?>>Práctico</option>
                            <option value="Teórico" <?php echo ($editando && $curso_edit['modalidad_desc'] == 'Teórico') ? 'selected' : ''; ?>>Teórico</option>
                            <option value="Práctico-Teórico" <?php echo ($editando && $curso_edit['modalidad_desc'] == 'Práctico-Teórico') ? 'selected' : ''; ?>>Práctico-Teórico</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Créditos ECTS:</label>
                        <div class="input-group">
                            <input type="number" name="creditos" class="form-control" value="<?php echo $curso_edit['creditos']; ?>" placeholder="ej: 60" min="0" required>
                            <span class="input-group-text bg-light text-muted">créditos ECTS</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Duración:</label>
                        <div class="input-group">
                            <input type="number" name="duracion" class="form-control" value="<?php echo $curso_edit['duracion']; ?>" placeholder="ej: 12" min="0" required>
                            <span class="input-group-text bg-light text-muted">meses</span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Prácticas:</label>
                        <input type="text" name="practicas" class="form-control" value="<?php echo $curso_edit['practicas']; ?>" placeholder="ej: Centros especializados" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Dirigido a:</label>
                        <input type="text" name="dirigido_a" class="form-control" value="<?php echo $curso_edit['dirigido_a']; ?>" placeholder="ej: Profesionales sanitarios" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Inversión / Precio:</label>
                        <div class="input-group">
                            <input type="number" name="precio" class="form-control" value="<?php echo $curso_edit['precio']; ?>" placeholder="ej: 9999" min="0" required>
                            <span class="input-group-text bg-light text-muted">€</span>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Descripción del Máster:</label>
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

    <!-- MODAL CONFIRMAR ELIMINAR -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content border-0" style="border-radius: 12px; overflow: hidden; box-shadow: 0 8px 30px rgba(0,0,0,0.12);">

                <div style="padding: 28px 28px 0 28px;">
                    <div style="display: flex; align-items: flex-start; gap: 14px;">
                        <div style="width: 38px; height: 38px; border-radius: 8px; background: #fdf0ef; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="bi bi-trash" style="font-size: 17px; color: #c0392b;"></i>
                        </div>
                        <div>
                            <p style="margin: 0 0 4px; font-size: 15px; font-weight: 600; color: #1a1a1a;">Eliminar máster</p>
                            <p style="margin: 0; font-size: 13px; color: #6b7280; line-height: 1.5;">Esta acción no se puede deshacer.</p>
                        </div>
                    </div>

                    <div style="margin: 20px 0 0; padding: 12px 14px; background: #f9f9f9; border-radius: 8px; border: 1px solid #ebebeb;">
                        <p style="margin: 0; font-size: 12px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px;">Máster seleccionado</p>
                        <p id="modalNombreCurso" style="margin: 4px 0 0; font-size: 14px; font-weight: 600; color: #1a1a1a;"></p>
                    </div>
                </div>

                <div style="padding: 20px 28px 24px; display: flex; gap: 8px; justify-content: flex-end;">
                    <button type="button" data-bs-dismiss="modal"
                        style="padding: 8px 18px; font-size: 13px; border-radius: 7px; border: 1px solid #d1d5db; background: transparent; color: #374151; cursor: pointer; font-weight: 500;">
                        Cancelar
                    </button>
                    <a id="btnConfirmarEliminar" href="#"
                        style="padding: 8px 18px; font-size: 13px; border-radius: 7px; border: none; background: #c0392b; color: #fff; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="bi bi-trash" style="font-size: 13px;"></i> Eliminar
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmarEliminar(id, titulo) {
            document.getElementById('modalNombreCurso').textContent = titulo;
            document.getElementById('btnConfirmarEliminar').href = 'nuevo.php?eliminar=' + id;
            new bootstrap.Modal(document.getElementById('modalEliminar')).show();
        }
    </script>
</body>
</html>