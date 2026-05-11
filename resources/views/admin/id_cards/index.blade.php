@extends('layouts.admin')
@section('content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="p-6 border-b flex justify-between items-center bg-gray-50">
        <h2 class="font-bold text-gray-700 uppercase text-sm tracking-wider">Manage ID Cards</h2>
        <a href="{{ route('id_cards.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded text-xs font-bold">ADD NEW STUDENT</a>
    </div>
    
    <table class="w-full text-left">
        <thead class="bg-white border-b text-[10px] uppercase font-bold text-gray-400">
            <tr>
                <th class="px-6 py-4">Student Info</th>
                <th class="px-6 py-4">Program</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($cards as $card)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 flex items-center space-x-4">
                    <img src="{{ asset('storage/'.$card->profile_image) }}" class="w-10 h-10 rounded-full object-cover">
                    <div>
                        <p class="text-sm font-bold text-gray-800">{{ $card->name }}</p>
                        <p class="text-[10px] text-gray-400">{{ $card->mobile_number }}</p>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $card->program }}</td>
                <td class="px-6 py-4 text-right space-x-3">
                    <a href="{{ route('id_cards.pdf', $card->id) }}" target="_blank" class="text-red-600 hover:text-red-800"><i class="fa-solid fa-file-pdf"></i></a>
                    <a href="{{ route('id_cards.edit', $card->id) }}" class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-pen"></i></a>
                    <form action="{{ route('id_cards.destroy', $card->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this record?')">
                        @csrf @method('DELETE')
                        <button class="text-gray-400 hover:text-red-600"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection