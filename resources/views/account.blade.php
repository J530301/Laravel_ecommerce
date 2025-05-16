{{-- filepath: resources/views/account.blade.php --}}
@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">User Accounts</h2>
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow">
            <thead>
                <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Password</th>
                    <th class="py-3 px-6 text-left">Role</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach($users as $user)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6">{{ $user->id }}</td>
                    <form method="POST" action="{{ route('users.update', $user->id) }}" class="contents">
                        @csrf
                        @method('PUT')
                        <td class="py-3 px-6">
                            <input type="text" name="name" value="{{ $user->name }}" class="border rounded px-2 py-1 w-full" />
                        </td>
                        <td class="py-3 px-6">
                            <input type="email" name="email" value="{{ $user->email }}" class="border rounded px-2 py-1 w-full" />
                        </td>
                        <td class="py-3 px-6">
                            <input type="password" name="password" placeholder="New Password" class="border rounded px-2 py-1 w-full" />
                        </td>
                        <td class="py-3 px-6">
                            <select name="role" class="border rounded px-2 py-1 w-full">
                                <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                <option value="user" @if($user->role == 'user') selected @endif>User</option>
                            </select>
                        </td>
                        <td class="py-3 px-6 text-center flex gap-2 justify-center">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded shadow">Update</button>
                    </form>
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow">Delete</button>
                    </form>
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection