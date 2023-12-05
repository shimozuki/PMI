<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goldarah extends Model
{
    /**
     * @var string
     */
    protected $table = 'golongan_darah';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'name'
    ];
}
