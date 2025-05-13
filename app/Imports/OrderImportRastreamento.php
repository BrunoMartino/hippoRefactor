<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\ImportedOrder;
use App\Models\ImportedTracking;
use App\Models\ImportedOrderGroup;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;

class OrderImportRastreamento implements ToCollection
{

    protected $groupName;
    protected $moduleId = 4;

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

            ImportedTracking::create([
                'name' => $row[0],
                'type' => $row[1],
                'order_number' => $row[2],
                'nf_number' => $row[3],
                'whatsapp' => $row[4],
                'send_date' => date('Y-m-d', strtotime(str_replace('/', '-', $row[5]))),
                'contract' => $row[6],
                'carrier' => $row[7],
                'cod_rastreio' => $row[8],
                'link_rastreio' => $row[9],
                'birth_date' => date('Y-m-d', strtotime(str_replace('/', '-', $row[10]))),
                'gender' => $row[11],
                'uf' => $row[12],

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
