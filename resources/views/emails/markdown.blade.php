<x-mail::message>
    # Dear {{ $mailData['name'] }},
    You have created a new todo using our web app.
    Todo name :{{ $mailData['todo'] }}
    Created at :{{ $mailData['createdAt'] }}
    image: 
    <img class="rounded w-10 h-10 mt-5 block" src="{{ env('APP_URL') }}/storage/{{ $mailData['image'] }}" alt=""
        width="50" height="50">
    <x-mail::button :url="''">
        Click here
    </x-mail::button>
    Thank you
    {{ config('app.name') }}
</x-mail::message>
