@extends('layouts.admin')

@section('content')
    <!-- Authors table -->
    @component('admin.components.table', [
        'title' => 'Categories',
        'headers' => ['ID', 'Name', 'Created At', 'Actions'],
    ])
        @foreach ($categories as $category)
            <tr>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    {{ $category->id }}
                </td>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    {{ $category->name }}
                </td>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    {{ $category->created_at ?? '-' }}
                </td>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                    <a href="#" class="text-xs font-semibold leading-tight text-slate-400"> Edit </a>
                    <a href="#" class="text-xs font-semibold bg-red-600 px-3 py-2 leading-tight "> Delete </a>
                </td>
            </tr>
        @endforeach
    @endcomponent

    @include('admin.components.footer')
@endsection
