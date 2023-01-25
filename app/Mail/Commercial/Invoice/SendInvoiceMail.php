<?php

declare(strict_types=1);

namespace App\Mail\Commercial\Invoice;

use App\Mail\Commercial\DefaultLogoTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class SendInvoiceMail extends Mailable
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

        $pdf = \PDF::loadView('theme.invoices_template.template1.index', compact('invoice', 'companyLogo', 'hasHeader'));

        return $this->from(getCompany()->email, Str::upper(getCompany()->name))
            ->subject('FACTURE N°: '.$this->data->code)
            ->view('theme.Emails.Commercial.Invoice.SendInvoiceMail')
            ->with('data', (object) $this->data)
            ->attachData($pdf->output(), 'FACTURE-'.$this->data->code.'.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
