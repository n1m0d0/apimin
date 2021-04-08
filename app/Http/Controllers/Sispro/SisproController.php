<?php

namespace App\Http\Controllers\Sispro;

use Illuminate\Http\Request;
use App\Models\sispro\Demanda;
use App\Http\Controllers\ApiController;

class SisproController extends ApiController
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sispro = Demanda::findOrFail($id);
        return $this->showOne($sispro,200);
    }


}
