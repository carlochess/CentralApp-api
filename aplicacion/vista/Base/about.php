<div class="container-fluid" style="padding:50px;padding-top:70px;">
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Sobre de nosotros</h1>
        <div class="container">
            <ol>
                <?php
                $desarrolladores = explode("\n",file_get_contents(URL . 'public/documuentos/desarrolladores'));
                shuffle($desarrolladores);
                foreach ($desarrolladores as $desarrollador) {
                    echo '<li>' . $desarrollador . '</li>';
                }
                ?>
            </ol>
        </div>
    </div>
</div>