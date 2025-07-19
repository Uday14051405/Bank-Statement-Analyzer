<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return $this->users;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Mobile',
            'Role Name',
            'Image',
            'Created At',
            'Company Name',
            'PAN Card',
            'Aadhar Card',
            'PAN Number',
            'PAN Name',
            'GST',
            'Account Holder Name',
            'Bank Name',
            'Account Number',
            'IFSC Code',
            
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->mobile,
            $user->getRoleNames()->implode(', '),
            $user->image,
            optional($user->created_at)->format('d-m-Y H:i:s'),
            $user->company_name,
            $user->pan_card,
            $user->aadhar_card,
            $user->pan_number,
            $user->pan_name,
            $user->gst,
            $user->account_holder_name,
            $user->bank_name,
            $user->account_number,
            $user->ifsc_code
            
        ];
    }
}
