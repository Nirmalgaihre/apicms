@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Login Activities</h2>
        <span class="text-sm text-gray-500">Timezone: Asia/Kathmandu (+05:45)</span>
    </div>
    
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">IP Address</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date & Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-4 border-b border-gray-200 text-sm">
                        <p class="text-gray-900 whitespace-no-wrap font-medium">{{ $log->email }}</p>
                    </td>
                    <td class="px-5 py-4 border-b border-gray-200 text-sm">
                        <p class="text-gray-600 font-mono">{{ $log->ip_address }}</p>
                    </td>
                    <td class="px-5 py-4 border-b border-gray-200 text-sm">
                        <span class="relative inline-block px-3 py-1 font-semibold leading-tight {{ $log->is_successful ? 'text-green-900' : 'text-red-900' }}">
                            <span aria-hidden class="absolute inset-0 {{ $log->is_successful ? 'bg-green-200' : 'bg-red-200' }} opacity-50 rounded-full"></span>
                            <span class="relative text-xs uppercase">{{ $log->is_successful ? 'Success' : 'Failed' }}</span>
                        </span>
                    </td>
                    <td class="px-5 py-4 border-b border-gray-200 text-sm">
                        <div class="text-gray-900 whitespace-no-wrap">
                            {{-- This converts the DB timestamp to Nepal Time specifically --}}
                            {{ \Carbon\Carbon::parse($log->created_at)->timezone('Asia/Kathmandu')->format('M d, Y') }}
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ \Carbon\Carbon::parse($log->created_at)->timezone('Asia/Kathmandu')->format('h:i:s A') }} 
                            ({{ \Carbon\Carbon::parse($log->created_at)->timezone('Asia/Kathmandu')->diffForHumans() }})
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-5 py-5 border-b border-gray-200 bg-white text-center text-gray-500">
                        No login activities recorded yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $logs->links() }}
    </div>
</div>
@endsection