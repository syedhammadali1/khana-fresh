@component('mail::message')
# PRODUCT IS NEARLY OUT OF STOCK

The remaining stock of {{ $product->name }} is now less than the specified minimum of <strong>5</strong>. <br> <br>
<strong>Remaining stock: {{ $product->stock }}</strong> <br> <br>
You are advised to open the Admin's Product Page in order to replenish your inventory. <br> <br>
<strong>OR</strong> <br> <br>
Click the button below.
@component('mail::button', ['url' => route('products.edit',$product)])
Product Page
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
