<?php

namespace Fluzo\Foro;

class Post extends \Eloquent
{

    private $reglas = array(
        'nombre' => array('required', 'min:2', 'max:25',
            'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'),
        'mensaje' => 'required | max:5000',
        'email' => 'in:'  // Dato que debe venir vacio ya que se oculta mediante jquery (anti spam)
    );
    private $mensajes = array('regex' => 'El formato de el :attribute no es correcto, solo se permiten letras, números, espacios en blanco
    y guiones medios o bajos.');

    public function valida()
    {
        $validador = \Validator::make(\Input::all(), $this->reglas, $this->mensajes); // Validamos el formulario       
        return $validador;
    }

    public function tema()
    {
        return $this->belongsTo('Fluzo\Foro\Tema');
    }
    public function getPosts($tema)
    {
        return $tema->posts()->where('aprobado','=',true)->orderBy('created_at')->paginate(5);
    }
    public function savePost($mensaje)
    {
        $tema = new Post();
        $tema->cuerpo = $mensaje;
        $tema->autor = \Input::get('nombre');
        $tema->tema_id = \Input::get('tema_id');
        $tema->save();
    }    
    public function aprobar($id)
    {
        $contenido = Post::find($id);
        $contenido->aprobado = true;
        $contenido->save();        
    }    
    public function eliminar($id)
    {
        Post::destroy($id);
    }
    

}
