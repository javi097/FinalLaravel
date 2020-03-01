<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable=['nombre', 'detalle', 'foto', 'precio','categoria_id'];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function scopeCategoria_id($query, $v){

        if($v=='%'){
            return $query->where('categoria_id','like' ,$v)
            ->orWhereNull('categoria_id');
        }
        if($v==-1){
            return $query->whereNull('categoria_id');
        }
        if(!isset($v)){
            return $query->where('categoria_id','like' ,'%')
            ->orWhereNull('categoria_id');
        }
        return $query->where('categoria_id', $v);
    }
}
