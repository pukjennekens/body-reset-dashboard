@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
    <img src="{{ asset('img/logo.svg') }}" alt="{{ env('APP_NAME') }}" style="width: 200px; height: auto;">
</a>
</td>
</tr>
