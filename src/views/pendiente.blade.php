@extends('foro::base')
@section('title')
Administracion
@stop
@section('cuerpo')
<h1><a href="/admin">Administración</a> :: <a href="{{route('admin-foro')}}">Foro</a> -> Pendiente</h1>
<hr />
@if ( !is_null($contenidos) )
<article>
    @foreach ($contenidos as $contenido)
    <h2>{{{ isset($contenido->foro_id) ? 'Tema' : 'Post' }}}</h2>    
    <hr />    
    <div class="comentarios">
        <article>   
            <div class="cabecera-comentarios">              
                <header>
                    {{-- <!--                    <h3>Articulo: <a href="/blog/{{$contenido->articulo->slug}}-{{$contenido->articulo->id}}">{{$contenido->articulo->titulo}}</a></h3>--> --}}
                    <span>Id: {{ $contenido->id }}</span><br />
                    <span class="autor-comentario"><strong>{{ $contenido->autor }}</strong></span><br />
                    <span class="texto-secundario">{{ ucwords(strftime("%A, %d %B %Y - %H:%M",strtotime($contenido->created_at))) }}</span>
                </header>
            </div>
            <div class="cuerpo-comentarios">{{ $contenido->cuerpo }}</div>
        </article>
    </div>
    @endforeach    
</article>
<a href="/admin/foro/eliminar/{{{ isset($contenido->foro_id) ? 'tema' : 'post' }}}/{{ $contenido->id }}" class="btn btn-danger">Eliminar</a>
<a href="/admin/foro/aprobar/{{{ isset($contenido->foro_id) ? 'tema' : 'post' }}}/{{ $contenido->id }}" class="btn btn-success pull-right">Aprobar</a>
<nav class="texto-centrado"><?php echo $contenidos->links(); ?></nav>
@else
<h3 class="alert alert-info">Ningún contenido pendiente</h3>
@endif
@stop

