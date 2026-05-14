<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Stats --}}
            @php
                $total     = \App\Models\Blood::count();
                $available = \App\Models\Blood::where('status','available')->sum('bags');
                $used      = \App\Models\Blood::where('status','used')->sum('bags');
                $expired   = \App\Models\Blood::where('status','expired')->sum('bags');
            @endphp

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                <div class="bg-white shadow-sm sm:rounded-lg p-5 text-center">
                    <p class="text-3xl font-bold text-gray-800">{{ $total }}</p>
                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-wide">Total Records</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5 text-center">
                    <p class="text-3xl font-bold text-green-600">{{ $available }}</p>
                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-wide">Available Bags</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5 text-center">
                    <p class="text-3xl font-bold text-blue-600">{{ $used }}</p>
                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-wide">Used Bags</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5 text-center">
                    <p class="text-3xl font-bold text-gray-400">{{ $expired }}</p>
                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-wide">Expired Bags</p>
                </div>
            </div>

            {{-- Quick links --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <a href="{{ route('bloods.create') }}"
                   class="block bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md transition ease-in-out duration-150 border-l-4 border-red-500">
                    <p class="text-sm font-semibold text-gray-800">Add Blood Record</p>
                    <p class="text-xs text-gray-500 mt-1">Record a new blood donation entry.</p>
                </a>
                <a href="{{ route('reports.index') }}"
                   class="block bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md transition ease-in-out duration-150 border-l-4 border-red-400">
                    <p class="text-sm font-semibold text-gray-800">View Reports</p>
                    <p class="text-xs text-gray-500 mt-1">See inventory totals and export as PDF.</p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
