<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Application\Client\ImportClientFormRequest;
use App\Imports\ClientsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportClientController extends Controller
{
    //

    public function import(ImportClientFormRequest $request)
    {
        // dd($request->file);
        $file = $request->file('file');

        Excel::import(new ClientsImport, $file);

        return redirect()->back()->with('success', 'la list a été importé avec success');
    }
}
