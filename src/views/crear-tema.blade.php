@extends('foro::base')
@section('head')
@parent
<meta name="robots" content="noindex"> 
<meta name="description" content="Foro" />
<meta name="robots" content="noindex">
@stop
@section('title')
Foro
@stop
@section('cuerpo')
<h1>Foro</h1>
<hr />
<h2>{{ $foro->nombre }} <small>(Nuevo tema)</small></h2>

{{Session::flash('foro',Session::get('foro'))}}
{{Session::flash('path',Session::get('path'))}}

@include('foro::errores')

@if (Session::get('vista_previa'))
<h3 id="vista-previa">Vista previa</h3>
<div id="vista-previa-comentario" class="well">
{{ Session::get('mensaje', '') }}
</div>
@endif

{{ Form::open(array('url' => Request::path(),'id' => 'formulario-crear-tema','role' => 'form', 'class' => 'well well-lg')) }}
<div class="form-group">
{{ Form::label('nombre', 'Nombre') }}
{{ Form::text('nombre',null,array('class' => 'form-control')) }}
</div>
<div class="form-group">
{{ Form::label('titulo', 'Título') }}
{{ Form::text('titulo',null,array('class' => 'form-control')) }}
</div>

{{-- Este campo no aparecera en el formulario, se ocultara via jquery --}}
<div id="div-email" class="form-group">
{{ Form::label('email', 'Email') }}
{{ Form::text('email',null,array('class' => 'form-control')) }}
</div>


<div class="form-group">
{{ Form::label('mensaje', 'Mensaje') }}
{{ Form::textarea('mensaje',null,array('class' => 'form-control', 'rows' => '10')) }}
</div>
<span class="text-danger">Todos los temas son revisados antes de publicarse.</span><br>
<span>Etiquetas permitidas: <code>&lt;strong&gt;, &lt;a&gt;, &lt;pre&gt;</code>.</span><br>
<span>Ejemplos de uso:</span>
<ul>
    <li>&lt;strong&gt;<code>Tu texto</code>&lt;/strong&gt;</li>    
    <li>&lt;a href="http://encuentra.biz"&gt;<code>Tu texto</code>&lt;/a&gt;</li>
    <li>&lt;pre&gt;&lt;![CDATA[<br><code>Tu codigo html,css,php etc...</code><br>]]&gt;&lt;/pre&gt;</li>
</ul>
{{-- {{ Form::hidden('articulo_id', $articulo->id) }} --}}
<br />
{{ Form::submit('Vista previa',array('name'=>'boton','class' => 'btn btn-success btn-lg')) }}
@if (Session::get('vista_previa'))
    {{ Form::submit('Enviar',array('name'=>'boton','class' => 'btn btn-primary btn-lg')) }}
@endif
{{ Form::close() }}

@stop