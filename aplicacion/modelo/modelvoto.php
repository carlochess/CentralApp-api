
<?php

class ModelVoto {
    private $oMySQL;

    function __construct(MySQL $db) {
        $this->oMySQL = $db;
    }

    /** Retorna los votos de un solucion */
    function /* array(stdObject) */ getVotosSolucion($id) {
        return $this->oMySQL->ejecutarConsultaSelect('SELECT * FROM voto WHERE idSolucion='+$id);
    }
    
    /** Retorna los votos de una Convocatoria */
    function /* array(stdObject) */ getVotosConvocatoria($id) {
        return $this->oMySQL->ejecutarConsultaSelect('SELECT * FROM voto WHERE idConvocatoria='+$id);
    }
    
    /**
     * Verifica si un usuario ha votado la convocatoria o el solucion
     * @param type $id
     * @param type $sufragante
     * @param type $esConvocatoria
     * @return type
     */
    function haVotado($id, $sufragante, $esConvocatoria) {
        if($esConvocatoria)
            return $this->oMySQL->ejecutarConsultaSelect('SELECT * FROM voto WHERE idUsuario='.$sufragante.' AND idConvocatoria='.$id);
        else
            return $this->oMySQL->ejecutarConsultaSelect('SELECT * FROM voto WHERE idUsuario='.$sufragante.' AND  idUsuario='.$id);
    }
    
    /** Agrega un voto  a la convocatoria */
    function /* boolean */ votarConvocatoria($id, $sufragante) {
        $this->oMySQL->ejecutarConsultaI('INSERT INTO notificaciones(idUCausante, idUAfectado, motivo, leida)'
                . ' VALUES ('.$sufragante.','.$id.',"convocatoria",FALSE)');
        return $this->oMySQL->ejecutarConsultaI('INSERT INTO voto(idConvocatoria,idUsuario) VALUES ('.$id.', '.$sufragante.')');
        
    }
    
    /** Retorna los votos de una Convocatoria */
    function /* boolean */ votarSolucion($id, $sufragante) {
        return $this->oMySQL->ejecutarConsultaI('INSERT INTO voto(idSolucion,idUsuario) VALUES ('.$id.', '.$sufragante.')');
    }

    function terminarConexion() {
        $this->oMySQL->cerrarConexion();
    }

}
?>
