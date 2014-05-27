@extends('foro::base')
@section('head')
@parent
<meta name="description" content="Foro" />
@stop
@section('title')
Foro
@stop
@section('cuerpo')

@include('foro::migas')
<br><br>
@if (Input::get('page')<2)
<div class="panel panel-tema">
  <div class="panel-heading">
      <h3 class="panel-title">{{ $tema->autor }}<span class="pull-right">{{ ucwords(strftime("%A, %d %B %Y - %H:%M",strtotime($tema->created_at))) }}</span></h3>
  </div>
  <div class="panel-body">
    {{ $tema->cuerpo }}
  </div>
</div>
@endif

@foreach ( $posts as $post )
<div class="panel panel-primary">
  <div class="panel-heading">
      <h3 class="panel-title">{{ $post->autor }}<span class="pull-right">{{ ucwords(strftime("%A, %d %B %Y - %H:%M",strtotime($post->created_at))) }}</span></h3>
  </div>
  <div class="panel-body">
    {{ $post->cuerpo }}
  </div>
</div>
@endforeach
<nav class="texto-centrado">
{{ $posts->links() }}
</nav>


{{---------------------- FORMULARIO DE CREACION DE POST ------------------------------}}

{{-- Mensaje de confirmación de envio de post --}}
@if (isset($confirmacion)) 
<br><br>
<p class="alert alert-success">{{ $confirmacion }}</p>
@endif

@if (Session::get('vista_previa'))
<hr />
<h3 id="vista-previa">Vista previa</h3>
<div id="vista-previa-comentario" class="well">
{{ Session::get('mensaje', '') }}
</div>
@else
<h3>Nuevo comentario</h3>
@endif

@include('foro::errores')

{{Session::flash('path',Request::path())}}
{{ Form::open(array('route' =>array('crear-post',$tema->id),'id' => 'formulario-crear-tema','role' => 'form', 'class' => 'well well-lg')) }}
<div class="form-group">
{{ Form::label('nombre', 'Nombre') }}
{{ Form::text('nombre',null,array('class' => 'form-control')) }}
</div>

{{-- Este campo no aparecera en el formulario, se ocultara via jquery --}}
<div id="div-email" class="form-group">
{{ Form::label('email', 'Email') }}
{{ Form::text('email',null,array('class' => 'form-control')) }}
</div>


<div class="form-group">
{{ Form::label('mensaje', 'Mensaje') }}
{{ Form::textarea('mensaje',null,array('class' => 'form-control', 'rows' => '8')) }}
</div>
<span class="text-danger">Todos los temas son revisados antes de publicarse.</span><br>
<span>Etiquetas permitidas: <code>&lt;strong&gt;, &lt;a&gt;, &lt;pre&gt;</code>.</span><br>
<span>Ejemplos de uso:</span>
<ul>
    <li>&lt;strong&gt;<code>Tu texto</code>&lt;/strong&gt;</li>    
    <li>&lt;a href="http://encuentra.biz"&gt;<code>Tu texto</code>&lt;/a&gt;</li>
    <li>&lt;pre&gt;&lt;![CDATA[<br><code>Tu codigo html,css,php etc...</code><br>]]&gt;&lt;/pre&gt;</li>
</ul>
{{ Form::hidden('tema_id', $tema->id) }}
<br />
{{ Form::submit('Vista previa',array('name'=>'boton','class' => 'btn btn-success btn-lg')) }}
@if (Session::get('vista_previa'))
    {{ Form::submit('Enviar',array('name'=>'boton','class' => 'btn btn-primary btn-lg')) }}
@endif
{{ Form::close() }}


@stop


