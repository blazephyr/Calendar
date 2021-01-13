<!DOCTYPE html>
<html>
<head>
  <title>Laravel Fullcalender Add/Update/Delete Event Example Tutorial - Tutsmake.com</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" />
 <Style>

.fc-event { /* needs to be same precedence */
  padding: 2px; /* an override! */
  text-align: center;

}
 </Style>
<script src="https://cdn.jsdelivr.net/npm/moment@2.27.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
<script>
  $(document).ready(function () {
  var SITEURL = "{{url('/')}}";
 
  var calendar = $('#calendar').fullCalendar({
  editable: false,
  events: SITEURL + "fullcalendar",
  displayEventTime: false,
  editable: false,
  eventRender: function (event, element, view) {
  if (event.allDay === 'true') {
  event.allDay = true;
  } else {
  event.allDay = false;
  }
  },
  selectable: false,
  selectHelper: false,
  events:{!! json_encode($Events) !!},

 

  });
  });

  </script>
</head>
<body>
 
  <div class="container p-2">
    <h1>calendar</h1><hr>
    <div class="row">

      <div class="col-4">
<form action="/" method="post">
  @csrf
<label for="eventName" class="form-label">Event</label>

<input type="text" class="form-control" id="eventName" name="Event[eventName]" value="{{$EventData->eventName ?? old('Event.eventName')}}">
@error('Event.eventName')
<small class="text-danger">{{ $message }}</small>
@enderror

<div class="row">
  <div class="col-6">
    <label for="dateFrom" class="form-label">From</label>

<input type="date" class="form-control" id="dateFrom" name="Event[dateFrom]" value="{{$EventData->dateFrom ?? old('Event.eventFrom')}}">
@error('Event.dateFrom')
<small class="text-danger">{{ $message }}</small>
@enderror
  </div>
  <div class="col-6">
    <label for="dateTo" class="form-label">To</label>
<input type="date" class="form-control" id="dateTo" name="Event[dateTo]" value="{{$EventData->dateTo  ?? old('Event.eventTo')}}">
@error('Event.dateTo')
<small class="text-danger">{{ $message }}</small>
@enderror
  </div>
  <div class="col-12 pt-2 pl-4"> 

    <div class=" form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1" name="dow[][day]" value="Monday" 
      @foreach ($dow as $dayofweek)
      @if ($dayofweek->day == 'Monday')
    {!!'checked'!!}
  @endif
      @endforeach>
      <label class="form-check-label" for="exampleCheck1">Monday</label>
    </div>
    <div class=" form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck2" name="dow[][day]" value="Tuesday"
      @foreach ($dow as $dayofweek)
      @if ($dayofweek->day == 'Tuesday')
    {!!'checked'!!}
  @endif
      @endforeach>
      <label class="form-check-label" for="exampleCheck2">Tuesday</label>
    </div>
    <div class=" form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck3" name="dow[][day]" value="Wednesday"
      @foreach ($dow as $dayofweek)
      @if ($dayofweek->day == 'Wednesday')
    {!!'checked'!!}
  @endif
      @endforeach>
      <label class="form-check-label" for="exampleCheck3">Wednesday</label>
    </div>
    <div class=" form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck4" name="dow[][day]" value="Thursday"
      @foreach ($dow as $dayofweek)
      @if ($dayofweek->day == 'Thursday')
    {!!'checked'!!}
  @endif
      @endforeach>
      <label class="form-check-label" for="exampleCheck4">Thursday</label>
    </div>
    <div class=" form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck5" name="dow[][day]" value="Friday"
      @foreach ($dow as $dayofweek)
      @if ($dayofweek->day == 'Friday')
    {!!'checked'!!}
  @endif
      @endforeach>
      <label class="form-check-label" for="exampleCheck5">Friday</label>
    </div>
    <div class=" form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck6" name="dow[][day]" value="Saturday" 
      @foreach ($dow as $dayofweek)
      @if ($dayofweek->day == 'Saturday')
    {!!'checked'!!}
  @endif
      @endforeach>
      <label class="form-check-label" for="exampleCheck6">Saturday</label>
    </div>
    <div class=" form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck7" name="dow[][day]" value="Sunday"
      @foreach ($dow as $dayofweek)
      @if ($dayofweek->day == 'Sunday')
    {!!'checked'!!}
  @endif
      @endforeach>
      <label class="form-check-label" for="exampleCheck7">Sunday</label>
    </div>
    @error('dow.*.day')
    <small class="text-danger">{{ $message }}</small>
    @enderror

  </div>
</div>
<hr>
<button type="submit" class="btn btn-dark btn-block">Submit</button>
</form>
      </div>
      <div class="col"> 
        <div id='calendar'></div> 
       </div>
    </div>
    
     
  </div>
 
 
</body>

</html>