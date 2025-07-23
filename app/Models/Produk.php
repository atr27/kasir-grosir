<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table ='produk';
    protected $primaryKey = 'id_produk';
    protected $guarded = [];
    protected $fillable = [
        'kode_produk',
        'id_kategori',
        'nama_produk',
        'merek',
        'harga_beli',
        'harga_jual',
        'diskon',
        'stok'
    ];

    public static function boot() {
        parent::boot();
        self::creating(function ($model) {
            $model->kode_produk = IdGenerator::generate(['table' => 'produk', 'length' => 7, 'prefix' => 'P', 'field'=> 'kode_produk', 'reset_on_prefix_change'=>true]);
        });
    }
}
