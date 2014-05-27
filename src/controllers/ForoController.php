<?php
namespace Fluzo\Foro;
use Fluzo\Foro\Foro;
use Fluzo\Foro\Tema;
use Fluzo\Foro\Post;

class ForoController extends \BaseController
{

    private $foro;
    private $tema;
    private $post;

    public function __construct(Foro $foro, Tema $tema, Post $post)
    {
        $this->foro = $foro;
        $this->tema = $tema;
        $this->post = $post;
    }

    public function inicio()
    {
        $foros = $this->foro->getForos(0);

//        foreach ($foros as $foro)
//        {
//            $cont_subforos[$foro->id] = Foro::where('id_padre', '=', $foro->id)->count();            
//        }                
        return \View::make('foro::foros')->with(array('foros' => $foros));
    }

    public function unNivel($nivel1)
    {
        $foro = $this->foro->getForoBySlug($nivel1);
        if ($foro->id_padre !== '0')
        {
            App::abort(404);
        }  // Si no es de nivel1

        $subforos = $this->foro->getForos($foro->id);  // Comprobamos si tiene subforos y los mostramos
        if ($subforos->count() > 0)
        {
            return \View::make('foro::foros')->with(array('nivel1' => $foro, 'foros' => $subforos));
        }

        $temas = $this->tema->getTemas($foro);  // Si no tuviera subforos mostramos los temas               
        return \View::make('foro::temas')->with(array('nivel1' => $foro, 'temas' => $temas, 'confirmacion' => \Session::get('confirmacion')));
    }

    public function dosNiveles($nivel1, $nivel2)
    {
        $foro_nivel1 = $this->foro->getForoBySlug($nivel1);
        if ($foro_nivel1->id_padre !== '0')
        {
            App::abort(404);
        }  // Si no es de nivel1
        
        $foro_nivel2 = $this->foro->getForoBySlug($nivel2);        
        if (is_null($foro_nivel2)) // Si no es un foro debe ser un tema
        {            
            $tema = $this->tema->getTema($nivel2, $foro_nivel1);
            $posts = $this->post->getPosts($tema);            
            return \View::make('foro::tema')->with(array('nivel1' => $foro_nivel1, 'nivel2' => $foro_nivel2, 'tema' => $tema,
                        'posts' => $posts, 'confirmacion' => \Session::get('confirmacion')));
        }        
        if (is_null($foro_nivel2) or $foro_nivel2->id_padre !== $foro_nivel1->id)
        {
            App::abort(404);
        }  // Si el padre no es el de nivel1
        
        $subforos = $this->foro->getForos($foro_nivel2->id);  // Comprobamos si tiene subforos y los mostramos        
        if ($subforos->count() > 0)
        {
            return \View::make('foro::foros')->with(array('nivel1' => $foro_nivel1, 'nivel2' => $foro_nivel2, 'foros' => $subforos));
        }

        $temas = $this->tema->getTemas($foro_nivel2);  // Si no tuviera subforos mostramos los temas        
        return \View::make('foro::temas')->with(array('nivel1' => $foro_nivel1, 'nivel2' => $foro_nivel2, 'temas' => $temas, 
            'confirmacion' => \Session::get('confirmacion')));
    }

    public function tresNiveles($nivel1, $nivel2, $nivel3)
    {        
        $foro_nivel1 = $this->foro->getForoBySlug($nivel1);
        if ($foro_nivel1->id_padre !== '0')
        {
            App::abort(404);
        }  // Si no es de nivel1

        $foro_nivel2 = $this->foro->getForoBySlug($nivel2);
        if ($foro_nivel2->id_padre !== $foro_nivel1->id)
        {
            App::abort(404);
        }  // Si el padre no es el de nivel1

        $foro_nivel3 = $this->foro->getForoBySlug($nivel3);                
        if (is_null($foro_nivel3)) // Si no es un foro debe ser un tema
        {            
            $tema = $this->tema->getTema($nivel3, $foro_nivel2);
            $posts = $this->post->getPosts($tema);            
            return \View::make('foro::tema')->with(array('nivel1' => $foro_nivel1, 'nivel2' => $foro_nivel2, 'nivel3' => $foro_nivel3, 'tema' => $tema,
                        'posts' => $posts, 'confirmacion' => \Session::get('confirmacion')));
        }
        if (is_null($foro_nivel3) or $foro_nivel3->id_padre !== $foro_nivel2->id)
        {
            App::abort(404);
        }  // Si el padre no es el de nivel1

        $subforos = $this->foro->getForos($foro_nivel3->id);  // Comprobamos si tiene subforos y los mostramos  // Comprobamos si tiene subforos y los mostramos
        if ($subforos->count() > 0)
        {
            return \View::make('foro::foros')->with(array('nivel1' => $foro_nivel1, 'nivel2' => $foro_nivel2, 'foros' => $subforos));
        }

        $temas = $this->tema->getTemas($foro_nivel3);  // Si no tuviera subforos mostramos los temas         
        return \View::make('foro::temas')->with(array('nivel1' => $foro_nivel1, 'nivel2' => $foro_nivel2, 'nivel3' => $foro_nivel3,
                    'temas' => $temas, 'confirmacion' => \Session::get('confirmacion')));
    }

    public function cuatroNiveles($nivel1, $nivel2, $nivel3, $nivel4)
    {
        $foro_nivel1 = $this->foro->getForoBySlug($nivel1);
        if ($foro_nivel1->id_padre !== '0')
        {
            App::abort(404);
        }  // Si no es de nivel1

        $foro_nivel2 = $this->foro->getForoBySlug($nivel2);
        if ($foro_nivel2->id_padre !== $foro_nivel1->id)
        {
            App::abort(404);
        }  // Si el padre no es el de nivel1

        $foro_nivel3 = $this->foro->getForoBySlug($nivel3);
        if ($foro_nivel3->id_padre !== $foro_nivel2->id)
        {
            App::abort(404);
        }  // Si el padre no es el de nivel2
        // En este caso, el nivel 4 debe ser obligatoriamente un tema
        $tema = $this->tema->getTema($nivel4, $foro_nivel3);
        $posts = $this->post->getPosts($tema);
        return \View::make('foro::tema')->with(array('nivel1' => $foro_nivel1, 'nivel2' => $foro_nivel2, 'nivel3' => $foro_nivel3, 'tema' => $tema,
                    'posts' => $posts, 'confirmacion' => \Session::get('confirmacion')));
    }

}
