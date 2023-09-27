<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'nombre' => $_POST['nombre'],
        'edad' => $_POST['edad'],
        'estado_civil' => $_POST['estado_civil'],
        'sexo' => $_POST['sexo'],
        'sueldo' => $_POST['sueldo']
    ];

    $archivo = 'empleados.json';

    // Verificar si el archivo existe y tiene contenido previo
    if (file_exists($archivo) && filesize($archivo) > 0) {
        $contenido_actual = file_get_contents($archivo);
        $datos_actuales = json_decode($contenido_actual, true);
    } else {
        // Si el archivo no existe o está vacío, inicializar el arreglo de datos
        $datos_actuales = [];
    }

    $datos_actuales[] = $datos;
    $nuevo_contenido = json_encode($datos_actuales);

    if (file_put_contents($archivo, $nuevo_contenido, LOCK_EX) !== false) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error al guardar los datos.";
    }
}
?>


<div class="card">
    <div class="card-header">
        <h1>Registro de Empleados</h1>
    </div>
    <div class="card-body">
        <form id="formulario" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre y Apellido:</label>
                <input type="text" name="nombre" id="nombre" pattern="[a-zA-Z\s]+" title="Ingresa un nombre válido (solo letras y espacios)" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="edad" class="form-label">Edad:</label>
                <input type="number" name="edad" id="edad" min="18" max="100" required class="form-control">
            </div>
            <div class="mb-3">
                <label for="estado_civil" class="form-label">Estado Civil:</label>
                <select name="estado_civil" id="estado_civil" required class="form-select">
                    <option value="soltero">Soltero</option>
                    <option value="casado">Casado</option>
                    <option value="viudo">Viudo</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo:</label>
                <div class="form-check">
                    <input type="radio" name="sexo" id="sexo_masculino" value="masculino" required class="form-check-input">
                    <label for="sexo_masculino" class="form-check-label">Masculino</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="sexo" id="sexo_femenino" value="femenino" required class="form-check-input">
                    <label for="sexo_femenino" class="form-check-label">Femenino</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="sueldo" class="form-label">Sueldo:</label>
                <div class="form-check">
                    <input type="radio" name="sueldo" id="sueldo_menor" value="menor_1000" required class="form-check-input">
                    <label for="sueldo_menor" class="form-check-label">Menos de 1000</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="sueldo" id="sueldo_entre" value="entre_1000_2500" required class="form-check-input">
                    <label for="sueldo_entre" class="form-check-label">Entre 1000 y 2500</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="sueldo" id="sueldo_mayor" value="mayor_2500" required class="form-check-input">
                    <label for="sueldo_mayor" class="form-check-label">Más de 2500</label>
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" value="Guardar" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>


