var that;
var Notificacion = function (url) {
    this.objContador = $(".notification-counter");
    this.url = url;
    that = this;
    this.ultimasNotificacionesLeidas();
    this.iniciarPeticiones();
    this.eliminarComportamientoPorDefecto();
    this.iniciarEscuchas();
};

Notificacion.prototype.iniciarPeticiones = function () {
    $.ajax({url: that.url + "notificaciones/consultar", success: function (data) {
            that.renderNotificaciones(JSON.parse(data), false);
            that.iniciarPeticiones();
        }});
};

Notificacion.prototype.ultimasNotificacionesLeidas = function () {
    $.ajax({url: that.url + "notificaciones/iniciales", success: function (data) {
            that.renderNotificaciones(JSON.parse(data), true);
        }});
};

Notificacion.prototype.actualizarContador = function (numNotificaciones)
{
    this.objContador.text(numNotificaciones);
    this.objContador.animate(
            {"top": "-=10px"},
    "fast");
    this.objContador.animate(
            {"top": "+=10px"},
    "fast");
};

Notificacion.prototype.renderNotificaciones = function (data, sonIniciales) {
    var $numeroDeElementos = data.length;
    $("#carrito").html('');
    if (parseInt($numeroDeElementos) < 3)
    {
        $('#carrito').css("height", 70 * (parseInt($numeroDeElementos) + 1));
    } else
    {
        $('#carrito').css("height", 210);
    }

    if ($numeroDeElementos > 0)
    {
        for (var i = $numeroDeElementos - 1; i >= 0; --i)
        {
            $("#carrito").append('<li class="producto">' + data[i].motivo + '</li>');
            $("#carrito li:last-child").css("background", "url('" + this.url + "public/imagenes/usuarios/" + data[i].idUCausante + "x50.jpg" + "') no-repeat left center");
            $("#carrito").append('<li class="divider"></li>');
            if (!sonIniciales) {
                alertify.log("Tienes una notificacion", "", 10);
            }
        }
    }
    else
    {
        $('#carrito').css("height", 70);
    }

    $("#carrito").append('<li class="divider"></li>');
    $("#carrito").append('<li class="verMas"><a href="' + this.url + 'notificaciones/todas">Ver mas</a></li>');
    if (!sonIniciales) {
        that.actualizarContador($numeroDeElementos);
    }
};

Notificacion.prototype.eliminarComportamientoPorDefecto = function () {
    $('.dropdown-toggle').dropdown();
    $('.dropdown input, .dropdown label').click(function (e) {
        e.stopPropagation();
    });
    $('.dropdown-menu').click(function (e) {
        e.stopPropagation();
    });
};

Notificacion.prototype.iniciarEscuchas = function () {

};
//---------