<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ClientsImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithUpserts
{
    public function model(array $row): ?\Illuminate\Database\Eloquent\Model
    {
        $data = [
            'entreprise' => $row['entreprise'],
            'contact' => $row['contact'],
            'telephone' => $row['telephone'],
            'email' => $row['email'],
            'addresse' => $row['addresse'],
            'rc' => $row['rc'],
            'ice' => $row['ice'],
        ];

        return Client::create($data);
    }

    /**
     * @return string|array
     */
    public function uniqueBy(): array|string
    {
        return ['ice', 'telephone', 'email'];
    }
}
