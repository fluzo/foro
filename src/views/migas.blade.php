    @if (isset($nivel1) and isset($nivel2) and isset($nivel3))
    <a href="{{ route('foro')}}">Inicio</a> »
    <a href="{{ route('foro-level1',array('nivel1'=>$nivel1->slug )) }}"> {{ $nivel1->nombre }}</a> »
    <a href="{{ route('foro-level2',array('nivel1'=>$nivel1->slug,'nivel2'=>$nivel2->slug )) }}"> {{ $nivel2->nombre }}</a> »
        @if (isset($tema->titulo))
            <a href="{{ route('foro-level3',array('nivel1'=>$nivel1->slug,'nivel2'=>$nivel2->slug,'nivel3'=>$nivel3->slug )) }}"> {{ $nivel3->nombre }}</a> »
            <span id="tema-titulo">{{ $tema->titulo }}</span>       
        @else
            <span id="tema-titulo">{{ $nivel3->nombre }}</span>
        @endif        

    @elseif (isset($nivel1) and isset($nivel2))
    <a href="{{ route('foro')}}">Inicio</a> »
    <a href="{{ route('foro-level1',array('nivel1'=>$nivel1->slug )) }}"> {{ $nivel1->nombre }}</a> »
        @if (isset($tema->titulo))
            <a href="{{ route('foro-level2',array('nivel1'=>$nivel1->slug,'nivel2'=>$nivel2->slug )) }}"> {{ $nivel2->nombre }}</a> »
            <span id="tema-titulo">{{ $tema->titulo }}</span>       
        @else
            <span id="tema-titulo">{{ $nivel2->nombre }}</span>
        @endif

    @elseif (isset($nivel1))
    <a href="{{ route('foro')}}">Inicio</a> »
       @if (isset($tema->titulo))
        <a href="{{ route('foro-level1',array('nivel1'=>$nivel1->slug )) }}"> {{ $nivel1->nombre }}</a> »
        <span id="tema-titulo">{{ $tema->titulo }}</span>
        @else
        <span id="tema-titulo">{{ $nivel1->nombre }}</span>
       @endif
    @else
    <a href="{{ route('foro')}}">Inicio</a>
    @endif

    