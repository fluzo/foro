<?php

namespace Fluzo\Foro;

use Fluzo\Foro\Tema as Tema;
use Fluzo\Foro\Post as Post;

class AdminController extends \BaseController
{
    private $tema;
    private $post;

    public function __construct(Tema $tema, Post $post)
    {
        $this->tema = $tema;
        $this->post = $post;
    }    

    public function mostrar()
    {
        $temas = Tema::where('aprobado', '=', false)->orderBy('created_at', 'asc')->paginate(1);
        $posts = Post::where('aprobado', '=', false)->orderBy('created_at', 'asc')->paginate(1);
        if (!is_null($posts->first()))
        {
            return \View::make('foro::pendiente')->with('contenidos', $posts);
        }        
        elseif (!is_null($temas->first()))
        {
            return \View::make('foro::pendiente')->with('contenidos', $temas);
        }
        return \View::make('foro::pendiente')->with('contenidos', null);
    }

    public function aprobar($tipo,$id)
    {
        if ($tipo==='tema')
        {
            $this->tema->aprobar($id);
        }
        elseif ($tipo==='post')
        {
            $this->post->aprobar($id);
        }            
        return \Redirect::route('admin-foro-pendiente');
    }

    public function eliminar($tipo,$id)
    {    
        if ($tipo==='tema')
        {
            $this->tema->eliminar($id);
        }
        elseif ($tipo==='post')
        {
            $this->post->eliminar($id);
        }         
        return \Redirect::route('admin-foro-pendiente');
    }

}
