@extends('layout.main')


@section('content')


    <div class="container-fluid" style="">

        <div class="top-nav green">
            <h3 class="white-text">Edit lecture</h3>
            <p class="flow-text white-text">
                Updating lecture information.
            </p>

        </div>

        <div class="content">

            <div class="row">
                <form method="post" class="col s12 m6 offset-m3" >
                    {{csrf_field()}}
                    <div class="input-field">
                        <input id="course_name" type="text" name="course_name" value="{{$lecture->getCourseName()}}">
                        <label for="course_name">Course Name</label>
                    </div>

                    <div class="input-field">
                        <input id="instructor_name" type="text" name="instructor_name" value="{{$lecture->getInstructor()}}">
                        <label for="instructor_name">Instructor Name</label>
                    </div>

                    <div class="input-field">
                        <input id="start_time" type="text" class="timepicker" name="start_time" value="{{$lecture->getStartTime()}}">
                        <label for="start_time">Start Time</label>
                    </div>

                    <div class="input-field">
                        <input id="duration" type="number" name="duration" value="{{$lecture->getDuration()}}">
                        <label for="instructor_name">Duration</label>
                    </div>

                    <div class="input-field">
                        <select name="device_id" id="hall" class="browser-default" value="{{$lecture->getDeviceId()}}">
                            <option  v-for="device in devices" :value="device.id" :selected="device.id == selected_device">@{{ device.location }}</option>
                        </select>
                    </div>






                    <br>
                    <br>
                    <br>

                    <button type="submit" class="waves-effect waves-light btn green">Save</button>

                </form>
            </div>

        </div>

    </div>


    <script>
        @if(!empty($updated))
            Materialize.toast('Successfully updated {{$updated}} lecture.' , 4000);
        @endif
    </script>

    <script>
        var app = new Vue({
            el: '#hall',
            data: {
                devices: [],
                selected_device: {{$lecture->getDeviceId()}}
            },
            created: function () {
                var self = this;
                $.ajax({
                    url: "{{url('/devicesid')}}",
                    success: function(data){
                        self.devices = JSON.parse(data);
                        console.log(self.devices);
                    },
                    timeout: 1000
                });
            }
        });
    </script>
    <script>

        $('.timepicker').pickatime({
            default: '{{$lecture->getStartTime()}}', // Set default time: 'now', '1:30AM', '16:30'
            fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
            twelvehour: false, // Use AM/PM or 24-hour format
            donetext: 'OK', // text for done-button
            cleartext: 'Clear', // text for clear-button
            canceltext: 'Cancel', // Text for cancel-button
            autoclose: false, // automatic close timepicker
            ampmclickable: true, // make AM PM clickable
            aftershow: function(){} //Function for after opening timepicker
        });
    </script>


@endsection