<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debit extends Model
{
    /**
     * @var string
     */
    protected $table = 'pendonor';

    /**
     * @var array
     */
    protected $fillable = [
        'nama_pendonor', 'no_hp', 'user_id', 'category_id', 'jml', 'description'
    ];
}
