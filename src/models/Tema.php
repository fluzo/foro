<?php

namespace Fluzo\Foro;

class Tema extends \Eloquent
{

    private $reglas = array(
        'nombre' => array('required', 'min:2', 'max:25',
            'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'),
        'titulo' => array('required', 'min:3', 'max:120',
            'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'),
        'mensaje' => 'required | max:5000',
        'email' => 'in:'  // Dato que debe venir vacio ya que se oculta mediante jquery (anti spam)
    );
    private $mensajes = array('regex' => 'El formato de el :attribute no es correcto, solo se permiten letras, números, espacios en blanco
    y guiones medios o bajos.');

    public function foro()
    {
        return $this->belongsTo('Fluzo\Foro\Foro');
    }

    public function posts()
    {
        return $this->hasMany('Fluzo\Foro\Post');
    }

    public function valida()
    {
        $validador = \Validator::make(\Input::all(), $this->reglas, $this->mensajes); // Validamos el formulario       
        return $validador;
    }

    public function slug_id($slug)
    {
        $array_slug = explode("-", $slug);
        $id = end($array_slug); // Id obtenido del slug
        $slug = substr($slug, 0, strrpos($slug, "-")); // Slug sin el id
        return array('id' => $id, 'slug' => $slug);
    }

    public function getTema($slug_tema, $foro)  // $foro es el foro al que pertenece el tema
    {
        $id_slug = $this->slug_id($slug_tema); // Separamos el id del slug para buscar por el            
        // Buscamos por id y slug, pero podria ser solo por id        
        return \Fluzo\Foro\Tema::where('id', '=', $id_slug['id'])->where('slug', '=', $id_slug['slug'])
                ->where('foro_id', '=', $foro->id)->where('aprobado', '=', true)->firstOrFail();
    }

    public function getTemas($foro)
    {
        return $foro->temas()->where('aprobado', '=', true)->orderBy('created_at')->paginate(8);
    }

    public function saveTema($mensaje)
    {
        $tema = new Tema();
        $tema->titulo = \Input::get('titulo');
        $tema->slug = \Str::slug(\Input::get('titulo'));
        $tema->cuerpo = $mensaje;
        $tema->autor = \Input::get('nombre');
        $tema->foro_id = \Request::segment(3);
        $tema->save();
    }
    public function aprobar($id)
    {
        $contenido = Tema::find($id);
        $contenido->aprobado = true;
        $contenido->save();        
    }      
    public function eliminar($id)
    {
        Tema::destroy($id);
    }    

}
