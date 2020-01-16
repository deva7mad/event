<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;

    public $table = 'leads';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'event',
        'created_at',
        'updated_at',
        'deleted_at',
        'category_id',
        'company_name',
        'contact_name',
        'contact_mail',
        'contact_number',
        'account_manager',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
