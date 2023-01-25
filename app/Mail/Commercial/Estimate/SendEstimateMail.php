<?php

namespace App\Mail\Commercial\Estimate;

use App\Mail\Commercial\DefaultLogoTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class SendEstimateMail extends Mailable
{
    use Queueable, SerializesModels;
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
        $estimate = $this->data;
        $hasHeader = true;
        $companyLogo = $this->getCompanyLogo();

        $pdf = \PDF::loadView('theme.estimates_template.template1.index', compact('estimate', 'companyLogo', 'hasHeader'));

        return $this->from(getCompany()->email, Str::upper(getCompany()->name))
            ->subject('DEVIS N°: '.$this->data->code)
            ->view('theme.Emails.Commercial.Estimate.SendEstimateMail')
            ->with('data', (object) $this->data)
            ->attachData($pdf->output(), 'DEVIS-'.$this->data->code.'.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
