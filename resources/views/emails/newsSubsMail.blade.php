<x-mail::message>
Newsly

Thnks for subscribing to our newsletter! We will keep you updated with the latest news and updates.

<x-mail::button :url="route('frontend.home')">
Visit our website
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
