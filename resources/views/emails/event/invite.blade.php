@component('mail::message')
# Invitation

Hi {{$guest['name']}},

your are invited from <b>{{$user->name}}</b> to attempt in the following event:

@component('mail::button', ['url' => url('event/' .$event->identifier)])
{{$event->title}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
