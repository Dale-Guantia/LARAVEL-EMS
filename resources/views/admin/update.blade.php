<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Employee') }}
        </h2>
    </x-slot>

    @vite('resources/views/admin/js/script.js')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold">Edit User</h3>
                    <hr/>

                    <p><a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back</a></p>

                    <form action="{{ route('admin/edit_form', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">E-mail</label>
                                <input type="text" name="email" class="form-control" value="{{$user->email}}">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">New Password</label>
                                <div class="input-group">
                                    <input id="password" type="password" name="password" autocomplete="new-password" class="form-control">
                                    <span class="input-group-text"><i class="bi bi-eye-slash" id="togglePassword"></i></span>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <div class="input-group">
                                    <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" class="form-control">
                                    <span class="input-group-text"><i class="bi bi-eye-slash" id="toggleConfirmPassword"></i></span>
                                </div>
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">User Type</label>
                                <select name="user_type" id="user_type" class="form-control">
                                    <option value="guest" {{ $user->user_type == 'guest' ? 'selected' : '' }}>Guest</option>
                                    <option value="employee" {{ $user->user_type == 'employee' ? 'selected' : '' }}>Employee</option>
                                </select>
                                @error('user_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="checkbox">&nbsp Approve &nbsp</label>
                                <input type="checkbox" id="checkbox" name="approved" value="1" {{ $user->approved ? 'checked' : '' }}>
                                @error('approved')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-grid">
                                <button class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
