@component('mail::message')
# Confirmation

Hi {{ $attendee->name }},

here you confirmation of your checkout.

@component('mail::panel')
{{ $attendee->sales()->first()->event->title}}
@endcomponent


@component('mail::table')
	| Ticket        | Quantity      | Price    |
	| ------------- |:-------------:| --------:|
	@foreach ($attendee->sales()->get() as $sale)
		| {{ $sale->ticket->name }} | {{ $sale->amount }} | {{ $sale->price }} |
	@endforeach
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
