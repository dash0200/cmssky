<x-app-layout title="Add Receptionist" page="Reception List">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Last Name</th>`
                                <th>Contact</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($receptions as $reception)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $reception->name }}</td>
                                    <td>{{ $reception->lname }}</td>
                                    <td>
                                        <div class="mb-1"> <label
                                                class="badge bg-purple-300">{{ $reception->email }}</label> </div>
                                        <div> <label class="badge bg-blue-300">{{ $reception->phone }}</label> </div>
                                    </td>
                                    <td>
                                        <div class="flex justify-start space-x-2">
                                            <x-badge-danger title="Delete" class="cursor-pointer"
                                                onclick="deleteDoctor('{{ $reception->ide }}')" />
                                            <a href="{{ route('admin.reception.edit', ['id' => $reception->ide]) }}">
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