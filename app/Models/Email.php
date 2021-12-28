<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Email extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'emails';

    /**
     * @var array|bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'contact_id',
        'email',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'contact_id' => 'integer',
        'email' => 'string',
    ];
}
