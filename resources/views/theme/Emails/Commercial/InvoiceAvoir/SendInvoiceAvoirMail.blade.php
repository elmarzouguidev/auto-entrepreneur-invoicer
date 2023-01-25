<div class="text" style="padding: 0 2.5em;">
    <p>Cher client,</p>
    <p> Veuillez trouver en pièce jointe la facture avoir <strong>{{$data->code}}</strong> .</p>
    <p> Détails de facture avoir :</p>
    <ul>
        <li><strong>N° de facture avoir : </strong> {{$data->code}}</li>
        <li><strong>N° de facture : </strong> {{$data->invoice_number}}</li>
        <li><strong>Date:</strong> {{$data->invoice_date->format('d-m-Y')}}</li>
        <li><strong>Montant: </strong> MAD {{ $data->formated_price_total }}</li>
    </ul>
    {{--<p>
        Si vous n'avez toujours pas communiqué votre ICE, merci de nous l'envoyer en
        réponse à ce mail ou à l'adresse {{$data->company->email}}.

        Notre service reste à votre disposition .
        pour toute demande veuillez nous contacter sur l'email suivant {{optional($data->company)->email}}.
    </p>--}}
</div>
