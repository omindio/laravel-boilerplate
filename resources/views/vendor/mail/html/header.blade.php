@props(['url'])
@php
    $path = public_path('images/logo.png');
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
@endphp
<tr>
    <td class="header">
        <a href="{{ config('app.frontend_url') }}" style="display: inline-block;">
            <img src="{{ $base64 }}" class="logo" alt="{{ config('app.name') }} Logo">
        </a>
    </td>
</tr>