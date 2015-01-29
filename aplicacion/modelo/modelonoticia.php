
<?php

class ModeloNoticia {
    private $oMySQL;

    function __construct(MySQL $db) {
        $this->oMySQL = $db;
    }

    /**  */
    function /* array(stdObject) */ getNoticiasDia($idUltimaNoticia) {
        return $this->oMySQL->seleccionar(
                'SELECT * FROM noticia WHERE idNoticia > ? ORDER BY idNoticia DESC  LIMIT 10', array($idUltimaNoticia));
    }
}
?>
