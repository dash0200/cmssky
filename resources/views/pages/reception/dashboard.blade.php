<x-app-layout>
    <div class="row">
        <x-people/>

        <div class="col-md-6 grid-margin transparent">
          <div class="row">
            <div class="col-md-6 mb-4 stretch-card transparent">
              <div class="card card-tale">
                <div class="card-body">
                  <p class="mb-4">Today’s Bookings</p>
                  <p class="fs-30 mb-2">{{$appointments_count}}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Today's Appointments</h4>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>
                      #
                    </th>
                    <th>
                      Patient Name
                    </th>
                    <th>
                      Reason
                    </th>
                    <th>
                      Doctor Selected
                    </th>
                    <th>
                      Status
                    </th>
                    <th>
                      Time Slot
                    </th>
                    <th>
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $app)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$app->patient_name}}</td>
                            <td>{{$app->reason}}</td>
                            <td>{{$app->doctor_name}}</td>
                            <td>{{$app->status}}</td>
                            <td>{{$app->time_slot}}</td>
                            <td>
                                <label for="">Assign Time</label>
                               <div class="d-flex items-center">
                                <input type="text" class="form-control time" style="height: 2rem; width: 5rem" id="time" placeholder="Time 2.30pm">
                                <select name="ampm" class="form-control" style="height: 2rem; width: 5rem" id="ampm">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                </select>
                                <label class="badge badge-info cursor-pointer">Assign</label>
                               </div>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td align="center" colspan="5">No Appointments Today</td>
                    </tr>
                    @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
 </x-app-layout>

 <script>
        $('.time').keypress(function (e) {    
            var charCode = (e.which) ? e.which : event.keyCode    
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57))    
                return false;                        
        }); 
 </script>