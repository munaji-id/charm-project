@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Charm')
<img src="http://23.251.154.236/favicon.ico" class="logo" alt="Charm Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
