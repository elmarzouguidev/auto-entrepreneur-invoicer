<?php

declare(strict_types=1);

namespace App\Mail\Commercial\InvoiceAvoir;

use App\Mail\Commercial\DefaultLogoTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class SendInvoiceAvoirMail extends Mailable
{
    use Queueable;
    use SerializesModels;
    use DefaultLogoTrait;

    private $data;

    /**
     * Create a new message instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->data->load('articles', 'client');

        $invoice = $this->data;
        $hasHeader = true;
        $companyLogo = $this->getCompanyLogo();

        $pdf = \PDF::loadView('theme.invoices_template.avoirs.index', compact('invoice', 'companyLogo', 'hasHeader'));

        return $this->from(getCompany()->email, Str::upper(getCompany()->name))
            ->subject('FACTURE AVOIR N°: '.$this->data->code)
            ->view('theme.Emails.Commercial.InvoiceAvoir.SendInvoiceAvoirMail')
            ->with('data', (object) $this->data)
            ->attachData($pdf->output(), 'FACTURE-'.$this->data->code.'.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
