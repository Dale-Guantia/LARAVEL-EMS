<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="text-2xl font-semibold">List of Employees</h3>
                        <a href="{{ route('employee/create') }}" class="btn btn-primary">Add Employee</a>
                    </div>
                    <hr/>
                    @if(session('success'))
                        <div class="alert alert-success p-2" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-hover table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Phone</th>
                                <th>Position</th>
                                <th>Salary</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                            <tr class="text-sm">
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $employee->name }}</td>
                                <td class="align-middle">{{ $employee->email }}</td>
                                <td class="align-middle">{{ $employee->phone }}</td>
                                <td class="align-middle">{{ $employee->position }}</td>
                                <td class="align-middle">{{ '₱ '.number_format($employee->salary) }}</td>
                                <td class="align-middle">{{ $employee->created_at->format('M d, Y - h:i A') }}</td>
                                <td class="align-middle">{{ $employee->updated_at->format('M d, Y - h:i A') }}</td>
                                <td class="align-middle">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('employee/edit_form', ['id'=>$employee->id]) }}" type="button" class="btn btn-secondary"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('employee/delete', ['id'=>$employee->id]) }}" type="button" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="9">Employee not found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
