@extends('layouts.admin')

@section('content')
    <!-- Authors table -->
    @component('admin.components.table', [
        'title' => 'Users',
        'headers' => ['Name', 'Email', 'Role', 'Actions'],
    ])
        @foreach ($users as $user)
            <tr>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <p class="mb-0 text-xs font-semibold leading-tight">{{ $user->name }}</p>
                </td>
                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <span class="text-xs font-semibold leading-tight">{{ $user->email }}</span>
                </td>
                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <span class="text-xs font-semibold leading-tight text-slate-400">{{ $user->role }}</span>
                </td>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <a href="#" class="text-xs font-semibold leading-tight text-slate-400"> Edit </a>
                    <a href="#" class="text-xs font-semibold bg-red-600 px-3 py-2 leading-tight"> Delete </a>
                </td>
            </tr>
        @endforeach
    @endcomponent

    @include('admin.components.footer')
@endsection
