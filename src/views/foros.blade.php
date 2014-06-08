@extends('foro::base')
@section('head')
@parent
<meta name="description" content="Foro {{$nivel2->nombre or ''}} | {{$nivel1->nombre or Request::server('SERVER_NAME')}}" />
@stop
@section('title')
Foro {{ $nivel2->nombre or ''}} | {{$nivel1->nombre or Request::server('SERVER_NAME')}}
@stop
@section('cuerpo')

@if (Auth::check() and Auth::user()->role === "admin")
<button type="button" class="btn btn-success pull-right">Añadir foro</button>
@endif

<h1>Foro</h1>
<hr />

@include('foro::migas')

{{-- Tabla de foros --}}
<table class="table table-bordered">
    <thead>
    <tr><th class="active" colspan="2"><h3>Foros</h3></th></tr>
</thead>
@foreach ($foros as $foro)
<tr>
    <td id="icono-foro"><span class="glyphicon glyphicon-tag"></span></td>
    <td id="nombre-foro">          
        @if (isset($nivel1) and isset($nivel2))
        <h4 class="pull-left"><a href="{{ route('foro-level3',array('nivel1'=>$nivel1->slug,'nivel2'=>$nivel2->slug,'nivel3'=>$foro->slug))}}">{{ $foro->nombre }}</a></h4>
        @elseif (isset($nivel1))
        <h4 class="pull-left"><a href="{{ route('foro-level2',array('nivel1'=>$nivel1->slug,'nivel2'=>$foro->slug))}}">{{ $foro->nombre }}</a> </h4>
        @else
        <h4 class="pull-left"><a href="{{ route('foro-level1',$foro->slug)}}">{{ $foro->nombre }}</a> </h4>
        @endif        
        
        @if (Auth::check() and Auth::user()->role === "admin")
        <a href="{{ route('admin-foro-eliminar',$foro->id) }}"><button type="button" class="btn btn-danger btn-xs pull-right">Eliminar</button></a>
        <button type="button" id="boton-modificar" class="btn btn-primary btn-xs pull-right">Modificar</button>
        @endif
    </td>
</tr>
@endforeach
</table>
@stop



