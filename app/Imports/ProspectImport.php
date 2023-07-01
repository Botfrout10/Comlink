<?php

namespace App\Imports;

use App\Models\Prospect;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProspectImport implements ToModel, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Prospect([
            'organisation' => $row['organisation'],
            'nom' => $row['nom_du_prospect'],
            'prenom' => $row['prenom'],
            'address' => $row['adresse'],
            'tel' => $row['portable'],
            'email' => $row['e_mail'],
            'remarque' => $row['remarques'],
            'date_premier_contact' => Date::excelToDateTimeObject($row['date_premier_contact']),
            'source_prospect' => $row['source_du_prospect'],
            'commercial_id' => $row['commercial_id'],
        ]);
    }
}
