<?php

namespace App\Http\Controllers\Sisfin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class SisfinController extends ApiController
{
    public function convenio($convenio)
    {
        $convenio = DB::connection('sisfin')->select('select id_convenio,nombre from sisfin.convenio where id_convenio=:convenio', ['convenio' => $convenio]);

        return $this->showArray($convenio[0]);
    }

    public function datosConvenio($codigoSisfin)
    {
        $convenio = DB::connection('sisfin')->select('
        SELECT "c".id_convenio, "c".nombre, "c".numero_contrato, "c".descripcion, "c".fecha_inicio, "c".fecha_termino, "c".id_organismo, "c".id_tipo_suscripcion,
            o.cod_presupuestario, o.abreviacion
        FROM
            sisfin.convenio AS "c"
        INNER JOIN clasificador.organismo AS o ON o.id_organismo = "c".id_organismo
        where c.codigo_sisfin=:codigoSisfin', ['codigoSisfin' => $codigoSisfin]);

        return $this->showArray($convenio[0]);
    }
}
