<?php

declare(strict_types=1);

namespace App\Http\Controllers\Export;

use App\Exports\ClientsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backup\ImportFileRequest;
use App\Imports\ClientsImport;
use App\Rules\StoreToDisk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClientExportController extends Controller
{
    public function export()
    {
        return Excel::download(new ClientsExport, 'clients.xlsx');
    }

    public function import(ImportFileRequest $request)
    {
        Excel::import(new ClientsImport, $request->file('file'));

        return redirect()->back()->with('success', 'All good!');
    }

    public function storeToDisk(Request $request)
    {
        $disk = (object) validator($request->route()->parameters(), [

            'disk' => ['required', new StoreToDisk()],

        ])->validate();

        $fileName = now()->format('d-m-Y').'-clients-list'.'.xlsx';

        $store = Excel::store(new ClientsExport, $fileName, $disk->disk);

        if ($store) {
            return redirect()->back()->with('success', 'Le backup a été crée avec success est sauvgarder sur google DRIVE');
        }

        return redirect()->back()->with('error', 'error ...');
    }
}
