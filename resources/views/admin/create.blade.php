<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    @vite('resources/views/admin/js/script.js')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-semibold">Add User</h3>
                    <hr/>

                    @if (session()->has('error'))
                        <div class="alert alert-danger p-2" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <p><a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back</a></p>

                    <form action="{{ route('admin/create/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input id="password" type="password" name="password" required autocomplete="new-password" class="form-control">
                                    <span class="input-group-text"><i class="bi bi-eye-slash" id="togglePassword"></i></span>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="form-control">
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
                                <select name="user_type" class="form-control">
                                    <option value="guest" {{ old('user_type') == 'guest' ? 'selected' : '' }}>Guest</option>
                                    <option value="employee" {{ old('user_type') == 'employee' ? 'selected' : '' }}>Employee</option>
                                </select>
                                @error('user_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label for="checkbox">&nbsp Approve &nbsp</label>
                                <input type="checkbox" id="checkbox" name="approved" value="1" {{ old('approved') ? 'checked' : '' }}>
                                @error('approved')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
