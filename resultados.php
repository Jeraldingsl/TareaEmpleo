<div class="card">
    <div class="card-header">
        <h2>Resultados</h2>
    </div>
    <div class="card-body">
        <table id="tabla-resultados" class="table">
            <thead>
                <tr>
                    <th>Nombre y Apellido</th>
                    <th>Edad</th>
                    <th>Estado Civil</th>
                    <th>Sexo</th>
                    <th>Sueldo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $datos = file_get_contents("empleados.json");
                $empleados = json_decode($datos, true);

                if ($empleados !== null) {
                    foreach ($empleados as $empleado) {
                        echo "<tr>";
                        echo "<td>" . $empleado['nombre'] . "</td>";
                        echo "<td>" . $empleado['edad'] . "</td>";
                        echo "<td>" . $empleado['estado_civil'] . "</td>";
                        echo "<td>" . $empleado['sexo'] . "</td>";
                        echo "<td>" . $empleado['sueldo'] . "</td>";
                        echo "</tr>";
                    }
                }

                if (file_exists('empleados.json')) {
                    $datos = file_get_contents('empleados.json');
                    $empleados = json_decode($datos, true);
            
                    // Calcular los resultados
                    $totalFemenino = 0;
                    $totalHombresCasados = 0;
                    $totalMujeresViudas = 0;
                    $edadTotalHombres = 0;
                    $contadorHombres = 0;
            
                    foreach ($empleados as $empleado) {
                        if ($empleado['sexo'] === 'femenino') {
                            $totalFemenino++;
                        }
            
                        if ($empleado['sexo'] === 'masculino' && $empleado['estado_civil'] === 'casado' && $empleado['sueldo'] === 'mayor_2500') {
                            $totalHombresCasados++;
                        }
            
                        if ($empleado['sexo'] === 'femenino' && $empleado['estado_civil'] === 'viudo' && $empleado['sueldo'] === 'mayor_1900') {
                            $totalMujeresViudas++;
                        }
            
                        if ($empleado['sexo'] === 'masculino') {
                            $edadTotalHombres += $empleado['edad'];
                            $contadorHombres++;
                        }
                    }
            
                    $promedioEdadHombres = $contadorHombres > 0 ? $edadTotalHombres / $contadorHombres : 0;
            
                    // Mostrar los resultados
                    echo '<ul>';
                    echo '<li>Total de empleados del sexo femenino: ' . $totalFemenino . '</li>';
                    echo '<li>Total de hombres casados que ganan más de 2500: ' . $totalHombresCasados . '</li>';
                    echo '<li>Total de mujeres viudas que ganan más de 1900: ' . $totalMujeresViudas . '</li>';
                    echo '<li>Edad promedio de hombres: ' . $promedioEdadHombres . '</li>';
                    echo '</ul>';
                } else {
                    echo '<p>No hay datos de empleados disponibles.</p>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
