<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\ImportedOrder;
use App\Models\ImportedBilling;
use App\Models\ImportedOrderGroup;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;

class OrderImportCobrancas implements ToCollection
{

    protected $groupName;
    protected $moduleId = 1;

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


            ImportedBilling::create([
                'name' => $row[0],
                'type' => $row[1],
                'order_number' => $row[2],
                'nf_number' => $row[3],
                'whatsapp' => $row[4],
                'contract' => $row[5],
                'birth_date' => date('Y-m-d', strtotime(str_replace('/', '-', $row[6]))),
                'issue_date' => date('Y-m-d', strtotime(str_replace('/', '-', $row[7]))),
                'due_date' => date('Y-m-d', strtotime(str_replace('/', '-', $row[8]))),
                'value' => $row[9],
                'link_boleto' => $row[10],
                'qr_code_pix' => $row[11],
                'payment_method' => $row[12],
                'gender' => $row[13],
                'uf' => $row[14],

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
