<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        margin: 0;
    }
</style>

<x-app-layout title="Edit Receptionist" page="Update Receptionist Info">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                {{-- <h4 class="card-title">Horizontal Two column</h4> --}}
                <form class="form-sample" id="doctor" method="post" action="{{ route('admin.reception.update') }}">
                    @csrf
                    <input type="text" value="{{$reception->id}}" hidden name="id">
                    <p class="card-description">
                        Personal info
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" required name="fname" class="form-control {{ $errors->has('fname') ? 'is-invalid' : '' }}"
                                    value="@if(old('fname') == null){{ $reception->name }}@else{{old('fname')}}@endif"
                                    >
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
                                    <input type="text" name="mname" class="form-control {{ $errors->has('mname') ? 'is-invalid' : '' }}"
                                    value="@if(old('mname') == null){{ $reception->mname }}@else{{old('mname')}}@endif"
                                    >
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
                                    <input type="text" name="lname" class="form-control {{ $errors->has('lname') ? 'is-invalid' : '' }}"
                                    value="@if(old('lname') == null){{ $reception->lname }}@else{{old('lname')}}@endif"
                                    >
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
                                        <option value="1" @if($reception->gender == 1) selected @endif>Male</option>
                                        <option value="0" @if($reception->gender == 0) selected @endif>Female</option>
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
                                    <input class="form-control {{ $errors->has('dob') ? 'is-invalid' : '' }}" value="{{$reception->dob->format("Y-m-d")}}" required name="dob" type="date"
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
                                <label class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <textarea name="address"  {{ $errors->has('address') ? 'is-invalid' : '' }} required id="address" class="form-control {{ $errors->has('fname') ? 'is-invalid' : '' }}" cols="20" rows="4">@if(old('address') == null){{ $reception->address }}@else{{old('address')}}@endif</textarea>
                                    @if ($errors->has('address'))
                                    <span class="invalid feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('address') }}.</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">City</label>
                                <div class="col-sm-9">
                                    <input type="text" value="@if(old('city') == null){{ $reception->city }}@else{{old('city')}}@endif" name="city" class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('city'))
                                    <span class="invalid feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('city') }}.</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" value="@if(old('email') == null){{ $reception->email }}@else{{old('email')}}@endif" required name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('email'))
                                    <span class="invalid feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('email') }}.</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="number" value="@if(old('phone') == null){{ $reception->phone }}@else{{old('phone')}}@endif" required name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('phone'))
                                    <span class="invalid feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('phone') }}.</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>