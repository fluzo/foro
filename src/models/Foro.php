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
        return Foro::where('id_padre', '=', $id_padre)->get();
    }
    public function getForoBySlug($slug)
    {
        return Foro::where('slug', '=', $slug)->first();
    }    
    public function getForoById($foro_id)
    {
        return Foro::where('id', '=', $foro_id)->first();
    }        

}
