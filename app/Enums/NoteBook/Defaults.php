<?php


namespace App\Enums\NoteBook;


use App\Enums\Enums;

class Defaults extends Enums
{
    const DEFAULT_COVER = '/static/img/noteBook.png';
    const DEFAULT_TYPE = Types::NORMAL;
    const DEFAULT_STATUS = Status::USED;
}
