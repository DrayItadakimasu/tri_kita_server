<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Auth;
use App\User;

class ExportUsers implements FromCollection, WithHeadings
{

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
            'Фамилия',
            'Имя',
            'Очество',
            'Телефон',
            'email',
            'Адрес регистрации',
            'Организация',
            'ИНН',
            'Работает с ндс',
            'Группа',
            'Зарегистрирован',
        ];
    }


}
