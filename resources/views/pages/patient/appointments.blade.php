<x-app-layout page="Appointments" title="Appointments">
    @php
        $session = Auth::user()
    @endphp
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{route('patient.storeAppointment')}}" method="post" id="app">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputPassword1">Select Doctors <span class="text-sm text-danger" id="docError"></span> </label>
                        <div class="d-flex justify-content-start gap-4 flex-wrap">
                            @foreach ($doctors as $doctor)
                                <x-radio title="{{ $doctor->name }}" name="doctor" id="dd"
                                    value="{{ $doctor->id }}"/>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1">Select Department <span id="depError" class="text-sm text-danger"></span> </label>
                        <div class="d-flex justify-content-start gap-4 flex-wrap">
                            @foreach ($departments as $dept)
                                <x-radio title="{{ $dept->department_name }}" name="department"
                                    value="{{ $dept->id }}" RadioType="info" />
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="exampleInputPassword1">Reason</label>
                            <input type="text" required name="reason" class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}" placeholder="Fever, Cough, Cold, Joint Pain, Chest Pain, Nausea">
                            @if ($errors->has('reason'))
                                <span class="invalid feedback" role="alert">
                                    <strong class="text-danger">{{ $errors->first('reason') }}.</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="name">Time slot <span  id="timeError" class="text-danger text-sm"></span> </label>
                            <select name="time" class="form-control" id="timeSlot">
                                <option value="">Select Time Slot</option>
                                <option value="10-11">10am - 11am</option>
                                <option value="11-12">11am - 12am</option>
                                <option value="12-13">12am - 1pm</option>
                                <option value="13-14">2pm - 3pm</option>
                                <option value="15-16">3pm - 4pm</option>
                                <option value="16-17">4pm - 5pm</option>
                                <option value="17-18">5pm - 6pm</option>
                            </select>
                        </div>
                        <input type="text" value="{{$session->user_id}}" name="id" hidden>
                        <div class="form-group col-lg-6">
                            <label for="exampleInputPassword1">Date <span id="dateError" class="text-sm text-danger"></span> </label>
                            <input type="date" class="form-control" id="date" name="date" placeholder="Date">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="{{$session->name}}" readonly>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="exampleInputPassword1">Phone</label>
                            <input type="text" readonly class="form-control" value="{{$session->email}}" placeholder="Phone">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" onclick="book()">Book</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    $('#date').attr('min',today);

    $("form").on("submit", function(e){
        e.preventDefault();
        
        let doc = $('input[name="doctor"]:checked').val()
        let dep = $('input[name="department"]:checked').val()
        let time = $("#timeSlot").val()
        let date = $("#date").val()

        if(doc == undefined) {
            $("#docError").text("Select Doctor")
        } else {
            $("#docError").text("")
        }

        if(dep == undefined) {
            $("#depError").text("Select Department")
        } else {
            $("#depError").text("")
        }

        if(time == '') {
            $("#timeError").text("Select Time slot")
        } else {
            $("#timeError").text("")
        }

        if(date == '') {
            $("#dateError").text("Select Date")
        } else {
            $("#dateError").text("")
        }

        if(doc !== undefined && dep !== undefined && time!=='' && date!=='') {
            this.submit()
        }
        
    })
</script>
