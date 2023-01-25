<?php

declare(strict_types=1);

namespace App\Mail\Commercial\BC;

use App\Mail\Commercial\DefaultLogoTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class SendBCMail extends Mailable
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
        $this->data->load('articles', 'provider');

        $command = $this->data;

        $hasHeader = true;

        $companyLogo = $this->getCompanyLogo();

        $pdf = \PDF::loadView('theme.bons_template.template1.index', compact('command', 'companyLogo', 'hasHeader'));

        return $this->from(getCompany()->email, Str::upper(getCompany()->name))
            ->subject('BC N°: '.$this->data->code)
            ->view('theme.Emails.Commercial.BC.SendBCMail')
            ->with('data', (object) $this->data)
            ->attachData($pdf->output(), 'BC-'.$this->data->code.'.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
