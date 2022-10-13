<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
</style>
<x-app-layout title="Add Receptionist" page="Reception Registration">
    <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <form class="form-sample" action="{{route('admin.reception.store')}}" method="post">
                @csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">First Name</label>
                    <div class="col-sm-9">
                      <input type="text" name="fname" class="form-control {{ $errors->has('fname') ? 'is-invalid' : '' }}">
                      @if ($errors->has('fname'))
                        <span class="invalid feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('fname') }}.</strong>
                        </span>
                        @endif
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Middle Name</label>
                    <div class="col-sm-9">
                      <input type="text" name="mname" class="form-control {{ $errors->has('mname') ? 'is-invalid' : '' }}">
                      @if ($errors->has('mname'))
                        <span class="invalid feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('mname') }}.</strong>
                        </span>
                        @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Last Name</label>
                      <div class="col-sm-9">
                        <input type="text" name="lname" class="form-control {{ $errors->has('lname') ? 'is-invalid' : '' }}">
                        @if ($errors->has('lname'))
                        <span class="invalid feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('lname') }}.</strong>
                        </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Gender</label>
                        <div class="col-sm-9">
                            <select name="gender" class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                                <option value="1" @if(old('gender') == 1) selected @endif>Male</option>
                                <option value="0" @if(old('gender') == 0) selected @endif>Female</option>
                            </select>
                            @if ($errors->has('gender'))
                            <span class="invalid feedback" role="alert">
                                <strong class="text-danger">{{ $errors->first('gender') }}.</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>               
              </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Date of Birth</label>
                        <div class="col-sm-9">
                            <input class="form-control {{ $errors->has('dob') ? 'is-invalid' : '' }}" value="{{old('dob')}}" required name="dob" type="date"
                                placeholder="dd/mm/yyyy">
                                @if ($errors->has('dob'))
                                <span class="invalid feedback" role="alert">
                                    <strong class="text-danger">{{ $errors->first('dob') }}.</strong>
                                </span>
                                @endif
                        </div>
                    </div>
                </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                            <input type="number" value="{{old('phone')}}" required name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}">
                            @if ($errors->has('phone'))
                            <span class="invalid feedback" role="alert">
                                <strong class="text-danger">{{ $errors->first('phone') }}.</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" value="{{old('email')}}" required name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                            @if ($errors->has('email'))
                            <span class="invalid feedback" role="alert">
                                <strong class="text-danger">{{ $errors->first('email') }}.</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <textarea name="address"  {{ $errors->has('address') ? 'is-invalid' : '' }} required id="address" class="form-control {{ $errors->has('fname') ? 'is-invalid' : '' }}" cols="20" rows="4">{{old('address')}}</textarea>
                            @if ($errors->has('address'))
                            <span class="invalid feedback" role="alert">
                                <strong class="text-danger">{{ $errors->first('address') }}.</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">City</label>
                        <div class="col-sm-9">
                            <input type="text" value="{{old('city')}}" name="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}">
                            @if ($errors->has('city'))
                            <span class="invalid feedback" role="alert">
                                <strong class="text-danger">{{ $errors->first('city') }}.</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
          </div>
        </div>
      </div>
</x-app-layout>