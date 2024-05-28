@component('mail::message')
# Maandelijks overzicht

Hier is het maandelijks overzicht:

@component('mail::table')
| Trainer          | Aantal afspraken |
| ---------------- |:----------------:|
@foreach ($data as $trainer => $count)
| {{ $trainer }} | {{ $count }} |
@endforeach
@endcomponent

@endcomponent