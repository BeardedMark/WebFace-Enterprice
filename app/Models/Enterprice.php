<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enterprice extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address',
        'publcation',
        'login',
        'password',
    ];

    public function getLink(): string
    {
        return url("{$this->address}/{$this->publcation}/hs/");
    }
}
