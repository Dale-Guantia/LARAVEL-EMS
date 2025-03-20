<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="text-2xl font-semibold">List of Users</h3>
                        <a href="{{ route('admin/create') }}" class="btn btn-primary">Add User</a>
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
                                <th>User type</th>
                                <th>Approved</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr class="text-sm">
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $user->name }}</td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle">{{ $user->user_type }}</td>
                                <td class="align-middle">{{ $user->approved == 1 ? 'Yes' : 'No' }}</td>
                                <td class="align-middle">{{ $user->created_at->format('M d, Y - h:i A') }}</td>
                                <td class="align-middle">{{ $user->updated_at->format('M d, Y - h:i A') }}</td>
                                <td class="align-middle">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{ route('admin/edit_form', ['id'=>$user->id]) }}" type="button" class="btn btn-secondary"><i class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('admin/delete', ['id'=>$user->id]) }}" type="button" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="9">User not found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
