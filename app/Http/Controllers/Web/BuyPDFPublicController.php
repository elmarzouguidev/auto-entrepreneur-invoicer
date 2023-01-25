<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Finance\Buy\BuyInvoice;
use Illuminate\Support\Facades\Response;

class BuyPDFPublicController extends Controller
{
    public function viewInvoice(BuyInvoice $invoice)
    {
        $file = $invoice->getFirstMedia('buy_invoices');

        if ($file->mime_type === 'application/pdf') {
            $headers = [
                'Content-Type' => 'application/pdf',
                'Content-disposition' => 'attachment; filename='.$file->file_name,
            ];

            //return response()->file($file->getPath(), $headers);
            return Response::make($file->getPath(), 200, [
                'Content-Type' => 'application/pdf', //Change according to the your file type
                'Content-Disposition' => 'inline; filename="'.$file->file_name.'"',
            ]);
        }

        return \PDF::loadFile(public_path().'/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');
    }
}
