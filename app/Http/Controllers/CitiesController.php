<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function indexJson(Request $request)
    {
        $data = file_get_contents("https://servicodados.ibge.gov.br/api/v1/localidades/estados/" . $request->uf . "/distritos?orderBy=nome");

        return $data;
    }
}
