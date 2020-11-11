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

    public function getListarPermisosByRol(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $rpta = DB::select('call sp_Rol_getListarPermisosByRol');
        return $rpta;
    }

    public function setRegistrarRolPermisos(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $cNombre = $request->cNombre;
        $cSlug  = $request->cSlug;

        $cNombre    = ($cNombre == Null) ? ($cNombre = '') : $cNombre;
        $cSlug    = ($cSlug == Null) ? ($cSlug = '') : $cSlug;

        try {
            DB::beginTransaction();

            $rpta = DB::select('call sp_Rol_setRegistrarRol (?, ?)', [
                $cNombre, $cSlug
            ]);

            $nIdRol = $rpta[0]->nIdRol;

            $listPermisos = $request->listPermisosFilter;
            $listPermisosSize = sizeof($listPermisos);

            if ($listPermisosSize > 0) {
                foreach ($listPermisos as $key => $value) {
                    if($value['checked'] == true) {
                        
                        DB::select('call sp_Rol_setRegistrarRolPermiso (?, ?)', [
                            $nIdRol, $value['id']
                        ]);
                    }
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}
