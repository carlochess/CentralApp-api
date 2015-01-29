
<!-- /#sidebar-wrapper --> 
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
                <div class="row placeholders"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h1 class="page-header">Ultimos usuario</h1>
                <div class="row placeholders"></div>
                <table class="table">
                    <?php for($i =0 ; $i<count($ultimosUsuarios) ; $i++){ ?>
                    <tr>
                        <td><?php echo $i; ?>.</td>
                        <td><?php echo $ultimosUsuarios[$i]->nombre; ?></td>
                    </tr>
                    <?php } ?>
                </table>
                <h1 class="page-header">Pasajeros mas activos</h1>
                <div class="row placeholders"></div>
                <table class="table">
                    <?php for($i =0 ; $i<count($pasajerosMasActivos) ; $i++){ ?>
                    <tr>
                        <td><?php echo $i; ?>.</td>
                        <td><?php echo $pasajerosMasActivos[$i]->nombre; ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-md-4">
                <a class="twitter-timeline"  href="https://twitter.com/hashtag/yaVoy" data-widget-id="548939219973193730">Tweets sobre #yaVoy</a>
                <script>!function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = p + "://platform.twitter.com/widgets.js";
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, "script", "twitter-wjs");</script>
            </div>
            <div class="col-md-4">
                <h1 class="page-header">Ultimos Pagos</h1>
                <div class="row placeholders"></div>
                <table class="table">
                    <?php for($i =0 ; $i<count($ultimosPagos) ; $i++){ ?>
                    <tr>
                        <td><?php echo $i; ?>.</td>
                        <td><?php echo $ultimosPagos[$i]->nombre; ?></td>
                        <td><?php echo $ultimosPagos[$i]->valor; ?></td>
                    </tr>
                    <?php } ?>
                </table>
                <h1 class="page-header">Taxistas mas activos</h1>
                <div class="row placeholders"></div>
                <table class="table">
                    <?php for($i =0 ; $i<count($taxistasMasActivos) ; $i++){ ?>
                    <tr>
                        <td><?php echo $i; ?>.</td>
                        <td><?php echo $taxistasMasActivos[$i]->nombre; ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>