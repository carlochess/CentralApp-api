<div class="container-fluid">
    <div class="main">
        <h1 class="page-header">Reportes</h1>

        <div class="panel panel-default">
            <div class="panel-body">
                Seleccionas las opciones para generar un reporte
            </div>
        </div>
        <div class="container">
            <form method="post" action="<?php echo URL . 'reporte/generarReporte'; ?>">
                <h1 class="page-header">Visuales</h1>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="convocatoria"> Convocatoria N 
                    </label>
                </div>

                <!--<button class="btn btn-success" type="summit"> aquí</button>-->
            </form>
        </div>

    </div>
</div>
