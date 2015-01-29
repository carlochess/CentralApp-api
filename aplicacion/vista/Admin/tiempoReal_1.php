<!--- Modal --->
<div class="modal fade  bs-example-modal-lg separar" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Agregar</h4>
            </div>
            <div class="modal-body">
                <div id="agregar">
                    <!--<form action="<?php echo URL . 'admin/encontrarRecorrido' ?>" method="POST" id="formulario" role="form">-->
                    <div class="form-group">
                        <label for="idTaxista" class="control-label">Taxista</label>
                        <select id="taxistas" name="idTaxista" multiple class="form-control">
                            <!--<option value="id">Nombre 1</option>-->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idRecorrido">Recorrido</label>
                        <select id="recorrido" name="idRecorrido" multiple class="form-control">
                            <!--<option value="id">Nombre 1</option>-->
                        </select>
                    </div>
                    <button type="button" id="hallar" class="btn btn-default" id="boton">Encontrar Recorrido</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <!--</form>-->
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">

    </div>
</div> 
<!--- Fin Modal 
<div class="sideBar">
    <div class="container">
        Propiedad 1
    </div>
</div>
--->
<div id="map_canvas" style="width:100%; height:70%"></div>
<div class="container" id="informacion">
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-2" style="border-style: solid;border-width: 0px; border-right-width: 5px;">
                    <h1> Opciones </h1>
                    <p>
                        <label>
                            <input type="button" name="optionsRadios" id="ruta_conductor" value="Ruta Conductor"/>
                        </label>
                        <label>
                            <input type="radio" name="optionsRadios" id="ninguna" value="ninguna" checked>
                            Ninguno
                        </label>
                        <label>
                            <input type="radio" name="optionsRadios" id="pasajero" value="pasajero" />
                            Pasajero
                        </label>
                        <label>
                            <input type="radio" name="optionsRadios" id="taxis" value="Taxis" />
                            Taxis
                        </label>
                        <label>
                            <input type="radio" name="optionsRadios" id="usuario" value="Usuarios" />
                            Pasajeros
                        </label>
                    </p>
                </div>
                <div class="col-md-10"  style="overflow-y: scroll;  height:200px;" id="logC">
                    <h1> Log </h1>
                    <p id="log"></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h1> Instrucciones </h1>
            <p>Elige una de las opciones. Has click dos veces en el mapa para determinar la posición inicial y final del recorrido</p>
            <button id="input">Log</button>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCxBd8CnKcGdqnbB1NF72eapJaewnvc-8s&sensor=true"></script>
<script src="<?php echo URL; ?>public/js/jquery-1.11.0.js"></script>
<script src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>
<script src="<?php echo URL; ?>public/js/jquery.easing.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/randomcolor/0.1.1/randomColor.min.js"></script>
<script type="text/javascript">
    $(function () {
        var map,
                directionsDisplay = new google.maps.DirectionsRenderer(),
                directionsService = new google.maps.DirectionsService();
        var mapOptions = {
            center: new google.maps.LatLng(3.380195790739837, -76.53779983520508),
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        directionsDisplay.setMap(map);
        wlog("Mapa creado");
        //-----
        var bounds;
        var ne;
        var sw;
        //-----
        var puntos = [];
        var nuevoPoligono;
        google.maps.event.addListener(map, 'click', clickSobreMapa);
        google.maps.event.addListener(map, 'bounds_changed', function () {
            bounds = map.getBounds();
            ne = bounds.getNorthEast();
            sw = bounds.getSouthWest();
        });
        ///  SI ha seleccionado la opción de taxis
        setInterval(function () {
            if (document.getElementById("taxis").checked) {
                var f = function (data) {
                    puntos.forEach(function (e) {
                        e.setMap(null);
                    });
                    var arreglo = JSON.parse(data);
                    arreglo.forEach(function (e) {
                        var temp = (e.posicion.substring(6, e.posicion.length - 2)).split(" ");
                        var punto = new google.maps.LatLng(temp[0], temp[1]);
                        puntos.push(new google.maps.Marker({
                            position: punto,
                            map: map,
                            title: e.idUsuario,
                            icon: "<?php echo URL; ?>public/imagenes/aaserver/taxi.png"
                        }));
                    });
                }
                enviarRes('getTaxisActivos',{mensaje:
                        ne.k + " " + ne.D + "," +
                        ne.k + " " + sw.D + "," +
                        sw.k + " " + sw.D + "," +
                        sw.k + " " + ne.D + "," +
                        ne.k + " " + ne.D}
                        , f);
            }
        }, 3000);
        //---------------------------------------
        setInterval(function () {
            if (document.getElementById("usuario").checked) {
                var f = function (data) {
                    puntos.forEach(function (e) {
                        e.setMap(null);
                    });
                    var arreglo = JSON.parse(data);
                    arreglo.forEach(function (e) {
                        var temp = (e.posicion.substring(6, e.posicion.length - 2)).split(" ");
                        var punto = new google.maps.LatLng(temp[0], temp[1]);
                        puntos.push(new google.maps.Marker({
                            position: punto,
                            map: map,
                            title: e.idUsuario,
                            icon: "<?php echo URL; ?>public/imagenes/aaserver/pasajero.png"
                        }));
                    });
                }
                enviarRes('getUsuarios', {mensaje:
                            ne.k + " " + ne.D + "," +
                            ne.k + " " + sw.D + "," +
                            sw.k + " " + sw.D + "," +
                            sw.k + " " + ne.D + "," +
                            ne.k + " " + ne.D}
                , f);
            }
        }, 3000);
        function agregarPoligono(puntos) {

            var coordenadas = [
                new google.maps.LatLng(puntos[0].k, puntos[0].B),
                new google.maps.LatLng(puntos[1].k, puntos[0].B),
                new google.maps.LatLng(puntos[1].k, puntos[1].B),
                new google.maps.LatLng(puntos[0].k, puntos[1].B),
            ];
            var color = randomColor({luminosity: 'dark'});
            nuevoPoligono = new google.maps.Polygon({
                paths: coordenadas,
                strokeColor: color,
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: color,
                fillOpacity: 0.35
            });
            nuevoPoligono.setMap(map);
            google.maps.event.addListener(nuevoPoligono, 'click', clickSobreMapa);
            calcularRuta(puntos[0], puntos[1]);
            enviarResultados('insertar',
                    puntos[0].k + "_" + puntos[0].B + "," +
                    puntos[0].k + "_" + puntos[1].B + "," +
                    puntos[1].k + "_" + puntos[1].B + "," +
                    puntos[1].k + "_" + puntos[0].B + "," +
                    puntos[0].k + "_" + puntos[0].B);
        }

        function calcularRuta(inicial, pfinal) {
            var modo = "DRIVING";
            var request = {
                origin: inicial,
                destination: pfinal,
                travelMode: google.maps.TravelMode[modo]
            };
            directionsService.route(request, function (response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    console.log(response.routes[0].overview_path);
                    response.routes[0].overview_path.forEach(function (city) {
                        var populationOptions = {
                            strokeColor: '#FF0000',
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: '#FF0000',
                            fillOpacity: 0.35,
                            map: map,
                            center: new google.maps.LatLng(city.k, city.B),
                            radius: 20
                        };
                        cityCircle = new google.maps.Circle(populationOptions);
                    });
                    directionsDisplay.setDirections(response);
                }
            });
        }

        function wlog(str) {
            var fecha = new Date();
            $("#log").append(fecha.getMinutes() + ":" + fecha.getSeconds() + " $ " + str + "<br/>");
            $("#logC").animate({scrollTop: $(document).height()}, "slow");
        }

        function clickSobreMapa(event) {
            if ($("#ruta").is(":checked") || $("#pasajero").is(":checked")) {
                //puntos.push(event.latLng);
                //var nombre = (puntos.length == 2) ? 'Punto A' : 'Punto B';
                var image = (puntos.length == 2) ? 'img/Start.png' : '<?php echo URL; ?>public/imagenes/aaserver/pasajero.png';
                if ($("#ruta").is(":checked")) {
                    image = "";
                    if (puntos.length == 2) {
                        wlog("ruta -> último punto " + puntos[1]);
                        agregarPoligono(puntos);
                        puntos = [];
                    } else {
                        wlog("ruta -> primer punto " + puntos[0]);
                    }
                }
                else if ($("#pasajero").is(":checked")) {
                    wlog("Pasajero  agregado  en " + event.latLng);
                    //enviarResultados("seleccionar", event.latLng.k + ", " + event.latLng.B);
                    /*if (puntos.length == 2) {
                     if (nuevoPoligono) {
                     if (google.maps.geometry.poly.containsLocation(puntos[0], nuevoPoligono) &&
                     google.maps.geometry.poly.containsLocation(puntos[1], nuevoPoligono)) {
                     wlog("Te puede llevar");
                     }
                     }
                     wlog("pasajero -> último punto " + puntos[1]);
                     puntos = [];
                     } else {
                     wlog("pasajero -> primer punto " + puntos[0]);
                     }*/
                }
                var marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map,
                    title: "nombre",
                    icon: image
                });
                google.maps.event.addListener(marker, 'rightclick', function (mouseEvent) {
                    this.setMap(null);
                });
            }
        }

        function enviarRes(op, mensaje, f) {
            $.post("<?php echo URL; ?>/admin/" + op,mensaje
                    , function (result) {
                        f(result);
                    });
        }
        $("#hallar").click(function () {
            var e = document.getElementById("taxistas");
            var f = document.getElementById("recorrido");
            var idTaxista = e.options[e.selectedIndex].value;
            var idServicio = f.options[f.selectedIndex].value;
            enviarRes("encontrarRecorrido", {idTaxista: idTaxista, idRecorrido:idServicio}, function (data) {
                var arreglo = JSON.parse(data);
                var poly = new google.maps.Polyline({ map: map, strokeColor: '#4986E7' });
                var path = poly.getPath();
                arreglo.forEach(function(e){
                    var p = e.posicion.split(" ");
                    path.push(new google.maps.LatLng(p[0],p[1]));
                });
            });
            $('#myModal').modal('hide');
        });
        //----------------------
        $("#ruta_conductor").click(function () {
            enviarRes('gerRecomendacionTaxistas', {mensaje: ""}, function (data) {
                agregarInfoASelect("taxistas", JSON.parse(data));
            });
            $('#myModal').modal();
        });
        $("#taxistas").change(function (d) {
            var e = document.getElementById(d.target.id);
            var id = e.options[e.selectedIndex].value;
            enviarRes('getServiciosTaxista', {mensaje: id}, function (data) {
                //wlog(data);
                agregarInfoASelect("recorrido", JSON.parse(data));
            });
        });
        //----------------------
        function agregarInfoASelect(nombreSelect, data) {
            //wlog(data);
            $('#' + nombreSelect).empty();
            data.forEach(function (e) {
                //wlog(e.id + e.nombre);
                $('#' + nombreSelect).append('<option value="' + e.id + '">' + e.nombre + '</option>');
            });
        }
    });</script>
<script type="text/javascript">
    $('.sideBar').toggle();
    $('#input').on('click', function () {
        $('.sideBar').toggle();
    })

</script>
<!--