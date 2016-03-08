<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardList extends Model
{
    protected $table = "board_lists";

    protected $fillable = [
        'board_id', 'user_id', 'list_name',
    ];
}