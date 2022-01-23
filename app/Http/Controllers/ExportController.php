<?php

namespace App\Http\Controllers;

use App\Exports\XformExport;
use App\Models\Xform;

class ExportController extends Controller
{
    public function xform(Xform $xform)
    {
        if (!$xform->data) {
            abort(404);
        }
        return (new XformExport($xform))->download('form-' . date('Ymd') . '.xlsx');
    }
}
