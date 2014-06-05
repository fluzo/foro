<?php

namespace Fluzo\Foro;

use Fluzo\Foro\Foro;
use Fluzo\Foro\Tema;

class TemaController extends \BaseController
{

    private $foro;
    private $tema;

    public function __construct(Foro $foro, Tema $tema)
    {
        $this->foro = $foro;
        $this->tema = $tema;
    }

    public function crear($foro_id)
    {
        $foro = $this->foro->getForoById($foro_id);
        return \View::make('foro::crear-tema')->with('foro', $foro);
    }

    public function validarTema($foro_id)
    {
        $validador = $this->tema->valida();
        if ($validador->passes())
        {
            $mensaje = \Input::get('mensaje');
            $mensaje = \Purifier::clean($mensaje);
            $mensaje = \Utilidades::fluzo_nl2br($mensaje);
            if (\Input::get('boton') === 'Vista previa') // Si venimos de vista previa, mostramos datos y recargamos con boton enviar visible.
            {
                return \Redirect::to(\Request::path() . '#vista-previa')
                                ->withInput()->with(array('mensaje' => $mensaje, 'vista_previa' => true, 'path' => \Session::get('path')));
            }
            elseif (\Input::get('boton') === 'Enviar') // Si venimos del boton enviar, grabamos y recargamos página.
            {
                // Guardamos el tema
                $this->tema->saveTema($mensaje,$foro_id);
                return \Redirect::to(\Session::get('path'))->with('confirmacion', 'Tu tema será publicado en cuanto lo revisemos, gracias.');
            }
        }
        else
        {
            return \Redirect::to(\Request::path())->withErrors($validador)->withInput()
                            ->with(array('foro' => \Session::get('foro'), 'path' => \Session::get('path')));
        }
    }

}
