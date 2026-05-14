<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Blood Reports</h2>
            <a href="{{ route('reports.pdf') }}"
               class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md transition ease-in-out duration-150">
                Export PDF
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Summary cards --}}
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                <div class="bg-white shadow-sm sm:rounded-lg p-5 text-center">
                    <p class="text-2xl font-bold text-gray-800">{{ $total }}</p>
                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-wide">Total Records</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5 text-center">
                    <p class="text-2xl font-bold text-green-600">{{ $available }}</p>
                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-wide">Available Bags</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5 text-center">
                    <p class="text-2xl font-bold text-blue-600">{{ $used }}</p>
                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-wide">Used Bags</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-5 text-center">
                    <p class="text-2xl font-bold text-gray-500">{{ $expired }}</p>
                    <p class="text-xs text-gray-500 mt-1 uppercase tracking-wide">Expired Bags</p>
                </div>
            </div>

            {{-- Breakdown table --}}
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-700">Breakdown by Blood Type</h3>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Blood Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Bags</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Available</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Used</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expired</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($byType as $r)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center justify-center w-12 h-7 bg-red-100 text-red-700 font-bold text-xs rounded-full">
                                    {{ $r->blood_type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-800">{{ $r->total_bags }}</td>
                            <td class="px-6 py-4 text-sm text-green-600 font-medium">{{ $r->available }}</td>
                            <td class="px-6 py-4 text-sm text-blue-600 font-medium">{{ $r->used }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 font-medium">{{ $r->expired }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm">
                                No data available yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
