<!DOCTYPE html>
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>
 document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: @json($events),
                });
                calendar.render();
            });
    </script>
    <div id='calendar'></div>
        </div>
        </div>
@endsection
