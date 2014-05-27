@extends('foro::base')
@section('title')
Administracion :: Foro
@stop

@section('cuerpo')
<h1><a href="/admin">Administración</a> :: Foro</h1>
<hr />
<a href="{{route('admin-foro-pendiente')}}">Pendiente</a>
@stop

