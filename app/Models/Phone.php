<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = ['name','image','description','category_id','price'];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
