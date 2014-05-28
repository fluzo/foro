<?php

namespace Fluzo\Foro;

use Fluzo\Foro\Post;

class PostController extends \BaseController
{

    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function crear($foro_id)
    {
        $foro = $this->foro->getForoById($foro_id);
        return \View::make('foro::crear-tema')->with('foro', $foro);
    }

    public function validarPost()
    {
        $validador = $this->post->valida();
        if ($validador->passes())
        {
            $mensaje = \Input::get('mensaje');
            $mensaje = \Purifier::clean($mensaje);
            $mensaje = \Utilidades::fluzo_nl2br($mensaje);
            if (\Input::get('boton') === 'Vista previa') // Si venimos de vista previa, mostramos datos y recargamos con boton enviar visible.
            {
                return \Redirect::to(\Session::get('path') . '#vista-previa')
                                ->withInput()->with(array('mensaje' => $mensaje, 'vista_previa' => true, 'path' => \Session::get('path')));
            }
            elseif (\Input::get('boton') === 'Enviar') // Si venimos del boton enviar, grabamos y recargamos página.
            {
                // Guardamos el tema
                $this->post->savePost($mensaje);
                return \Redirect::to(\Session::get('path') . '#confirmacion')->with('confirmacion', 'Tu comentario será publicado en cuanto lo revisemos, gracias.');
            }
        }
        else
        {
            return \Redirect::to(\Session::get('path') . '#error')->withErrors($validador)->withInput();
            //->with(array('foro' => Session::get('foro'), 'path' => Session::get('path')));
        }
    }

}
