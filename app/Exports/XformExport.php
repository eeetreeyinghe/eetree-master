<?php
namespace App\Exports;

use App\Models\XformData;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class XformExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;
    public $xform;

    public function __construct($xform)
    {
        $this->xform = $xform;
    }

    public function query()
    {
        return XformData::with('user')->where('xform_id', $this->xform->id);
    }

    public function headings(): array
    {
        $fields = [];
        foreach ($this->xform->data['fields'] as $field) {
            $fields[] = $field['__vModel__'];
        }
        return $fields;
    }

    public function map($xformData): array
    {
        $fields = [];
        foreach ($this->xform->data['fields'] as $field) {
            $fields[$field['__vModel__']] = '';
        }
        if ($xformData->data) {
            foreach ($xformData->data as $key => $value) {
                if (isset($fields[$key])) {
                    $fields[$key] = is_array($value) ? implode(' , ', $value) : $value;
                }
            }
        }
        return $fields;
    }
}
