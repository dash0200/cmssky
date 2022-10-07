<x-app-layout title="Doctor List" page="List of all Doctors">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Last Name</th>
                                <th>Department</th>
                                <th>Contact</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($doctors as $doctor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $doctor->name }}</td>
                                    <td>{{ $doctor->lname }}</td>
                                    <td>{{ $doctor->department }}</td>
                                    <td>
                                        <div class="mb-1"> <label
                                                class="badge bg-purple-300">{{ $doctor->email }}</label> </div>
                                        <div> <label class="badge bg-blue-300">{{ $doctor->phone }}</label> </div>
                                    </td>
                                    <td>
                                        <div class="flex justify-start space-x-2">
                                            <x-badge-danger title="Delete" class="cursor-pointer"
                                                onclick="deleteDoctor('{{ $doctor->ide }}')" />
                                            <a href="{{ route('admin.editDoctorInfo', ['id' => $doctor->ide]) }}">
                                                <x-badge-info title="Edit" class="cursor-pointer" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function deleteDoctor(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "delete",
                    url: "{{ route('admin.deleteDoctor') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(res) {
                        toast("Doctor Deleted", "success")
                    },
                    error: function(res) {
                        toast("something went wrond", 'error')
                    }
                });
            }
        })
    }

    function toast(title, icon) { //title = Signed in Success
        //icon = error, icon = success
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: icon,
            title: title
        })
    }
</script>
