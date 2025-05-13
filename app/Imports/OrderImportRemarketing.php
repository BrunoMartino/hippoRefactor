<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\ImportedOrder;
use App\Models\ImportedOrderGroup;
use Illuminate\Support\Collection;
use App\Models\ImportedRemarketing;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;

class OrderImportRemarketing implements ToCollection
{

    protected $groupName;
    protected $moduleId = 3;

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

        foreach ($rows as $row) {

            if ($row[0] == 'Nome')
                continue;

            ImportedRemarketing::create([
                'name' => $row[0],
                'type' => $row[1],
                'order_number' => $row[2],
                'nf_number' => $row[3],
                'whatsapp' => $row[4],
                'birth_date' => date('Y-m-d', strtotime(str_replace('/', '-', $row[5]))),
                'date_order' => date('Y-m-d', strtotime(str_replace('/', '-', $row[6]))),
                'date_nf' => date('Y-m-d', strtotime(str_replace('/', '-', $row[7]))),
                'date_contract' => date('Y-m-d', strtotime(str_replace('/', '-', $row[8]))),
                'contract' => $row[9],
                'gender' => $row[10],
                'uf' => $row[11],

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
