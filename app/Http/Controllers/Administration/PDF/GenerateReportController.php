<?php

namespace App\Http\Controllers\Administration\PDF;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GenerateReportController extends Controller
{
    public function ticketReport(Ticket $ticket)
    {
        //if ($ticket->can_make_report) {

        $ticket->load(['client', 'technicien', 'diagnoseReports', 'reparationReports', 'delivery'])->loadCount('delivery');
        $image = Media::whereModelType('App\Models\Ticket')->whereModelId($ticket->id)->first()->getPath('normal');
        $images = Media::whereModelType('App\Models\Ticket')->whereModelId($ticket->id)->get();

        $imagesPaths = $images->map(function ($item, $key) {
            //return $item->getPath('normal');
            return 'data:image/jpg;base64,'.base64_encode(file_get_contents($item->getPath('normal')));
        });

        $imagesPaths->all();

        $data = [
            'firstImage' => 'data:image/jpg;base64,'.base64_encode(file_get_contents($image)),
            'allImages' => $imagesPaths,

        ];
        //dd($images, 'oo', $data);

        $companyLogo = 'data:image/jpg;base64,'.base64_encode(file_get_contents($image));

        //dd($data,  $image,$companyLogo);

        $pdf = \PDF::loadView('theme.pages.Ticket.__pdf.Report.index', compact('ticket', 'data'));

        $fileName = $ticket->code.'RAPPORT.pdf';

        return $pdf->stream($fileName);
        //}

        //return redirect()->back()->with('error', 'not now');
    }
}
