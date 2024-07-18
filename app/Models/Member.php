<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';
    protected $primaryKey = 'id_member';
    protected $guarded = [];
    protected $fillable = [
        'kode_member',
        'nama',
        'alamat',
        'telepon'
    ];

    public static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->kode_member = IdGenerator::generate(['table' => 'member', 'length' => 8, 'prefix' => 'MBR', 'field'=> 'kode_member', 'reset_on_prefix_change' => true]);
        });
    }

}
