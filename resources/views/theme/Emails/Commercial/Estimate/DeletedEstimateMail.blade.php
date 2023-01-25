<div class="text" style="padding: 0 2.5em;">
    <p style="color: red">Alert de suppression,</p>
    <p> Veuillez trouver en pièce jointe le devis <strong>{{ $data->code }}</strong> .</p>
    <p> Détails de devis :</p>
    <ul>
        <li><strong>N° de devis:</strong> {{ $data->code }}</li>
        <li><strong>Société:</strong> {{ getCompany()->name }}</li>
        <li><strong>Date:</strong> {{ $data->estimate_date->format('d-m-Y') }}</li>
        <li><strong>Montant: </strong> MAD {{ $data->formated_price_total }}</li>
    </ul>
    <p>
        La <strong style="color: red">suppression</strong> a été effectuée par : {{ auth()->user()->full_name }} :
        {{ now()->format('d-m-Y H:i') }}
    </p>
</div>
