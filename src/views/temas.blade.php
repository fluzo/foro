@extends('foro::base')
@section('head')
@parent
<meta name="description" content="Foro" />
@stop
@section('title')
Foro
@stop
@section('cuerpo')

@if (isset($nivel1) and isset($nivel2) and isset($nivel3))
<a href="{{ route('crear-tema',$nivel3->id) }}"><button type="button" class="btn btn-success pull-right">Nuevo tema</button></a>
@elseif (isset($nivel1) and isset($nivel2))
<a href="{{ route('crear-tema',$nivel2->id) }}"><button type="button" class="btn btn-success pull-right">Nuevo tema</button></a>
@elseif (isset($nivel1))
<a href="{{ route('crear-tema',$nivel1->id) }}"><button type="button" class="btn btn-success pull-right">Nuevo tema</button></a>
@endif


{{Session::flash('path',Request::path())}}

@include('foro::migas')

@if (isset($confirmacion))
<br><br>
<p class="alert alert-success">{{ $confirmacion }}</p>

@elseif (is_null($temas->first()))
<br><br>
<p class="alert alert-info">Este foro aun no tiene temas, se el primero en publicar uno.</p>
@else
<table class="table table-bordered">
    <thead>
        <tr><th class="active" colspan="2"><h3>Temas</h3></th></tr>
</thead>
@foreach ($temas as $tema)
<tr>
    <td id="icono-foro"><span class="glyphicon glyphicon-tag"></span></td>
    <td id="nombre-tema">
        @if (isset($nivel1) and isset($nivel2) and isset($nivel3))
        <h4><a href="{{ route('foro-level4',array('nivel1'=>$nivel1->slug,'nivel2'=>$nivel2->slug,'nivel3'=>$nivel3->slug,'nivel4'=>$tema->slug.'-'.$tema->id)) }}">{{ $tema->titulo }}</a></h4>
        @elseif (isset($nivel1) and isset($nivel2))
        <h4><a href="{{ route('foro-level3',array('nivel1'=>$nivel1->slug,'nivel2'=>$nivel2->slug,'nivel3'=>$tema->slug.'-'.$tema->id))}}">{{ $tema->titulo }}</a></h4>
        @elseif (isset($nivel1))
        <h4><a href="{{ route('foro-level2',array('nivel1'=>$nivel1->slug,'nivel2'=>$tema->slug.'-'.$tema->id))}}">{{ $tema->titulo }}</a></h4>
        @endif
    </td>
</tr>
@endforeach
</table>
@endif

@stop