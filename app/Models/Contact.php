<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $primaryKey='id';
    // モデルのIDを自動増分しない
    public $incrementing=false;
    // モデルにタイムスタンプを付けない
    public $timestamps=false;

    protected $fillable=[
        'fullname',
        'gender',
        'email',
        'postcode',
        'address',
        'building_name',
        'opinion',
        'created_at'
    ];

    public static function getDate($from, $until)
    {
        $items = Contact::whereBetween("created_at", [$from, $until])->Paginate(10);

        return $items;
    }
}
