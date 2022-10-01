<ul class="nav">
 <x-sidebar-single-item title="Dashboard" link="{{route('dashboard')}}" icon="icon-grid" />

 @switch(Auth::user()->user_type)
  
     @case("admin")
        <x-sidebar-item title="Doctors" icon="mdi mdi-docotor" active="{{request()->routeIs('admin.d.*')}}">
            <x-sidebar-submenu-link link="{{route('admin.d.addDoctor')}}" title="Add Docotor"/>
            <x-sidebar-submenu-link link="{{route('admin.d.doctorList')}}" title="Doctors List"/>
        </x-sidebar-item>

        <x-sidebar-item title="Masters" icon="mdi mdi-docotor" active="{{request()->routeIs('admin.master.*')}}" >
            <x-sidebar-submenu-link link="{{route('admin.master.addDepartment')}}" title="Add Department"/>
        </x-sidebar-item>
         @break

     @case("patient")
         <x-sidebar-item title="Appointments" icon="mdi mdi-calendar-text" >
            <x-sidebar-submenu-link link="{{route('patient.appointments')}}" title="Book an Appointment"/>
            <x-sidebar-submenu-link link="{{route('patient.appointmentHistory')}}" title="Appointment History"/>
         </x-sidebar-item>
         @break

     @case("doctor")
         
         @break

     @case("reception")
         
         @break

     @default
     <x-sidebar-single-item title="DD" link="{{route('dashboard')}}" icon="icon-grid" />
 @endswitch


</ul>