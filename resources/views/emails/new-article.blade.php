@component('mail::message')

Yeni bir gönderi yayınlandı.

@component('mail::button', ['url' => ''])
İncele
@endcomponent

Teşekkürler,<br>
{{ config('app.name') }}
@endcomponent
