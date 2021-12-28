<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Phone extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'phones';

    /**
     * @var array|bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'contact_id',
        'phone',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'contact_id' => 'integer',
        'phone' => 'string',
    ];
}
