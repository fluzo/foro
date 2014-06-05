<?php
namespace Fluzo\Foro;
class Foro extends \Eloquent
{

    public function temas()
    {
        return $this->hasMany('Fluzo\Foro\Tema');
    }

    public function getForos($id_padre)
    {
        return Foro::where('id_padre', '=', $id_padre)->orderBy('nombre','asc')->get();
    }
    public function getForoBySlug($slug,$id_padre)
    {
        return Foro::where('slug', '=', $slug)->where('id_padre', '=', $id_padre)->first();
    }    
    public function getForoById($foro_id)
    {
        return Foro::where('id', '=', $foro_id)->first();
    }        

}
