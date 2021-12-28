<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

final class Contact extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'contacts';

    /**
     * @var array|bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'name' => 'string',
    ];

    /**
     * @return HasMany
     */
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class, 'contact_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function emails(): HasMany
    {
        return $this->hasMany(Email::class, 'contact_id', 'id');
    }
}
