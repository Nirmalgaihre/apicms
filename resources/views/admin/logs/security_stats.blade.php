@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6">Security Analytics</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded shadow">
            <p class="text-gray-600 text-sm">Total Login Traffic</p>
            <p class="text-3xl font-bold">{{ $stats['total_attempts'] }}</p>
        </div>
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded shadow">
            <p class="text-gray-600 text-sm">Successful Logins</p>
            <p class="text-3xl font-bold">{{ $stats['successful'] }}</p>
        </div>
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded shadow">
            <p class="text-gray-600 text-sm">Blocked/Failed Attempts</p>
            <p class="text-3xl font-bold">{{ $stats['failed'] }}</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4 text-red-700">Top Suspicious IPs (Failed Attempts)</h3>
        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-2">IP Address</th>
                    <th class="py-2 text-right">Failed Hits</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stats['suspicious_ips'] as $ip)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 font-mono text-sm">{{ $ip->ip_address }}</td>
                    <td class="py-2 text-right text-red-600 font-bold">{{ $ip->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection