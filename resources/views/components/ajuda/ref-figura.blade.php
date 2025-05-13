@php
    $numero = $id;
    $texto = "figura $numero";
    $link = "<a href=\"#figura$id\"><strong>$texto</strong></a>";
@endphp

{!! ($parens ?? false) ? "($link)" : $link !!}
