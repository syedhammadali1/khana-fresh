@component('mail::message')
# Less than 96 hours left in your {{ $data['week'] }} delivery

Your meal delivery time is less than 96 hours therefore if you are willing to change your meal now? <br> Just click the link below.
@component('mail::button', ['url' => $data['btn-url'] ])
Edit Your Menu
@endcomponent
@component('mail::table')
| Product       | Quantity      |
|:-------------:|:-------------:|
@foreach ($data['old_product'] as $key => $item)
| {{ $key }}     |  {{ $item }}      |
@endforeach
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
