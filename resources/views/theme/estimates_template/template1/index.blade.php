<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ optional($estimate->client)->entreprise }} - {{ $estimate->estimate_date->format('d-m-Y') }}</title>
    <style>
        @page {
            margin: 60px 20px;
        }

        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #000;
            -webkit-print-color-adjust: exact;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 5px;
            margin-bottom: 5px;
            font-style: italic;
            color: #000;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 900px;
            @if (!$hasHeader)
             margin-top: 30%;
            @else 
             margin: auto;
            @endif
            padding: 2px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 17px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #000;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: start;
          
        }

        .invoice-box table tr td:nth-child(3) {
            text-align: start;
        }

        .invoice-box table tr td:nth-child(4) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 10px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #000;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 2px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.heading-price td {
            background: #eee;
            /*border-bottom: 2px solid #325288;*/
            font-weight: bold;
            text-align: right;
        }

        .invoice-box table tr.details td {
            padding-bottom: 10px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
            font-size: 13px !important;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .invoice-box table tr.total td:nth-child(3) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .bott {
            height: 0px;
            width: 200px;
            border-bottom: solid #1572A1 20px;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        footer {
            position: fixed;
            bottom: -10px;
            left: 0px;
            right: 0px;
            height: 50px;
            /** Extra personal styles **/

            color: white;
            text-align: center;
            line-height: 10px;
        }

        #watermark {
            position: fixed;

            /**
                Set a position in the page for your image
                This should center it vertically
            **/
            bottom: 10cm;
            left: 5.5cm;

            /** Change image dimensions**/
            width: 8cm;
            height: 8cm;

            /** Your watermark should be behind every content**/
            z-index: -1000;
        }

    </style>
</head>

<body>
    <footer>
        @if($hasHeader)
            <div style="text-align: center; color:#333; font-size: 11px !important;">
                <p>{{ getCompany()->name }}</p>
                <p>
                    {{ getCompany()->addresse }}
                    Tel : {{ getCompany()->telephone_a }}
                    E-mail : {{ getCompany()->email }}
                </p>
                <p>
                    -R.C:{{ getCompany()->rc }}
                    -PATENTE:{{ getCompany()->patente }}
                    -I.F:{{ getCompany()->if }}
                    -CNSS:{{ getCompany()->cnss }}
                    -ICE:{{ getCompany()->ice }}
                </p>
            </div>
            <div class="bott" style=" width: 100%;">
            </div>
        @endif
    </footer>

    <!------------------To be contuned -------------------->
    {{-- <div id="watermark">
        <img src="{{ $companyLogo }}" height="100%" width="100%" />
       </div> --}}

    @if ($hasHeader)
        <div class="invoice-logo" style="margin-top: -50px; margin-bottom:50px">
            <table>
                <tr>
                    <td style="text-align: left;">
                        <img src="{{ $companyLogo }}" style="width: 25%;" />
                    </td>
                </tr>
            </table>
        </div>
    @endif
    <div class="invoice-box">
        <table>
            
            <tr class="information">
                <td colspan="5">
                    <table>
                        <tr>
                            <td style="width: 30% ;">
                                <strong>DEVIS N° : {{ $estimate->code }}</strong><br />
                                Date : {{ $estimate->estimate_date->format('d-m-Y') }}<br />
                                {{-- Date d'échéance : {{ $estimate->due_date }} --}}
                            </td>
                            <td style="width: 30% ;">
                            </td>
                            <td style="width: 30% ;">
                                <strong>{{ optional($estimate->client)->entreprise }}</strong> <br />

                                {{ optional($estimate->client)->addresse }} <br />
                                ICE : {{ optional($estimate->client)->ice }}<br />

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td colspan="5">Mode de payement</td>
    
            </tr>
    
            <tr class="details">
                <td colspan="5">{{ $estimate->payment?->name}}</td>
    
            </tr>

                {{-- <tr class="heading">
                    <td colspan="5">Réferences client</td>

                </tr>
                <tr class="details">
                    <td colspan="5">
                        BL : {{ $invoice->bl_code }}

                        BC : {{ $invoice->bc_code }}
                    </td>
                </tr> --}}

            <tr class="heading">
                <td>Désignation</td>
                <td>Qté</td>
                <td>P.U HT</td>
                <td>Remise</td>
                <td>Montant HT</td>
            </tr>

            @foreach ($estimate->articles as $article)
                <tr class="item {{ $loop->last ? 'last' : '' }}">
                    <td style="width: 52% ;">
                        <strong>
                            {!! $article->designation !!}
                        </strong>
                        <br>
                        {!! $article->description !!}
                    </td>
                    <td>{{ $article->quantity }}</td>
                    <td>{{ $article->formated_prix_unitaire }} DH</td>

                    <td>
                        @if($article->remise > 0 && $article->remise !== 0)
                         {{--$article->formated_price_remise--}}
                         {{$article->remise}} %
                        @endif
                    </td>

                    <td>{{ $article->formated_montant_ht }} DH</td>
                </tr>
            @endforeach

            <div class="pricer">
                <tr class="heading-price lefter">
                    <td colspan="5">
            
                        Montant HT : {{$estimate->formated_price_ht}} DH
                      
                    </td>
                
                </tr>
                @if($estimate->formated_total_remise > 0 )
                    <tr class="heading-price lefter">
                        <td colspan="5">REMISE : {{$estimate->formated_total_remise}} DH</td>
                    </tr>               
                    
                @endif
                <tr class="heading-price lefter">
                    <td colspan="5">TVA 20% : {{ $estimate->formated_total_tva }} DH</td>
                </tr>
                <tr class="heading-price lefter">
                    <td colspan="5">Montant TTC : {{ $estimate->formated_price_total }} DH</td>
                </tr>
            </div>

        </table>

    </div>

    @if(isset($estimate->condition_general) && $estimate->condition_general != null)
        <div style="text-align: left;font-size: 12px;color:black">
            <p>Condition général</p>
            <p>{!! $estimate->condition_general !!}</p>
        </div>
    @endif
    <script type="text/php">

        if (isset($pdf) && $PAGE_COUNT > 1) {
                    $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
                    $size = 5;
                    $font = $fontMetrics->getFont("Verdana");
                    $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                    $x = ($pdf->get_width() - $width);
                    $y = $pdf->get_height() - 35;
                    $pdf->page_text($x, $y, $text, $font, $size);
                }


    </script>
</body>

</html>
