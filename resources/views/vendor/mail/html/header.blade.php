<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="{{ asset('frontend/assets/img/Khana-fresh-Logo.png') }}" width="100" height="100" class="logo" alt="{{ $slot }} Logo">
@endif
</a>
</td>
</tr>
