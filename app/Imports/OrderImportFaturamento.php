<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\ImportedOrder;
use App\Models\ImportedInvoicing;
use App\Models\ImportedOrderGroup;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;

class OrderImportFaturamento implements ToCollection
{

    protected $groupName;
    protected $moduleId = 2;

    public function __construct($groupName)
    {
        $this->groupName = $groupName;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Support\Collection|null
     */
    public function collection(Collection $rows)
    {

        $groupId = $this->createGroupId();

        foreach ($rows as $key => $row) {

            if ($row[0] == 'Nome' || $row[0] == 'nome')
                continue;

            ImportedInvoicing::create([
                'name' => $row[0],
                'type' => $row[1],
                'order_number' => $row[2],
                'nf_number' => $row[3],
                'contract' => $row[4],
                'whatsapp' => $row[5],
                'link_nf' => $row[6],
                'link_xml' => $row[7],
                'birth_date' => date('Y-m-d', strtotime(str_replace('/', '-', $row[8]))),
                'gender' => $row[9],
                'uf' => $row[10],
                'situacao' => $row[11],

                'user_id' => user_princ()->id,
                'group_id' => $groupId,
                'module_id' => $this->moduleId,
            ]);
        }
    }

    public function createGroupId()
    {
        $group = ImportedOrderGroup::create([
            'name' => $this->groupName,
            'user_id' => user_princ()->id,
            'module_id' => $this->moduleId
        ]);

        return $group->id;
    }

    public function isJson($string): bool
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
