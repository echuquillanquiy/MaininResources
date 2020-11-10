<?php

namespace App\Http\Controllers\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function getListarRoles(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $cNombre = $request->cNombre;
        $cSlug  = $request->cSlug;

        $cNombre    = ($cNombre == Null) ? ($cNombre = '') : $cNombre;
        $cSlug    = ($cSlug == Null) ? ($cSlug = '') : $cSlug;

        $rpta = DB::select('call sp_Rol_getListarRoles (?, ?)', [
            $cNombre, $cSlug
        ]);
        return $rpta;
    }
}
