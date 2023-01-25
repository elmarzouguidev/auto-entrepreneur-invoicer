<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Events\AfterSheet;

class ClientsExport implements FromQuery, FromCollection, WithHeadings, WithColumnWidths, WithProperties, ShouldAutoSize, WithEvents
{
    use Exportable;

    private $colums;

    public function __construct($colums = null)
    {
        if ($colums) {
            $this->colums = $colums;
        }
        // $this->ville = null;
    }

    public function columnWidths(): array
    {
        return [
            'G' => 65,
            'H' => 20,
            'I' => 20,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'code',
            'entreprise',
            'contact',
            'telephone',
            'email',
            'addresse',
            'rc',
            'ice',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(16);
            },
        ];
    }

    public function query()
    {
        // dd($this->colums,'from here');
        //if($this->ville){
        //dd('yes in query ville');
        return Client::query()->get();
        //->where('ville', $this->colums);
        // $ook =  $dataa->unique('cnicode');
        //->where('ville', $this->colums);
        //  return $ook;

        // }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Client::select(['id', 'code', 'entreprise', 'contact', 'telephone', 'email', 'addresse', 'rc', 'ice'])->get();
    }

    public function properties(): array
    {
        return [
            'creator' => 'ERP CASAMAINTENANCE',
            'lastModifiedBy' => 'ERP CASAMAINTENANCE',
            'title' => 'Clients Export',
            'description' => 'list des Clients',
            'subject' => 'Clients',
            'keywords' => 'Clients,export,spreadsheet',
            'category' => 'Clients',
            'manager' => auth()->user()->full_name,
            'company' => 'CASAMAINTENANCE',
        ];
    }
}
