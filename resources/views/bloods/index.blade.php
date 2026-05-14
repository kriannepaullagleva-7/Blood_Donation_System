<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Blood</h2>
            <a href="{{ route('bloods.create') }}"
               class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md transition ease-in-out duration-150">
                + Add Record
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded-md text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Blood Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bags</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donation Date</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($bloods as $b)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $b->donor_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <span class="inline-flex items-center justify-center w-12 h-7 bg-red-100 text-red-700 font-bold text-xs rounded-full">
                                    {{ $b->blood_type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $b->bags }}</td>
                            <td class="px-6 py-4 text-sm">
                                <td class="px-6 py-4 text-sm">
                                    @if($b->status === 'available')
                                        <span class="px-2 py-1 text-xs font-semibold text-green-700">Available</span>
                                    @elseif($b->status === 'used')
                                        <span class="px-2 py-1 text-xs font-semibold text-blue-700">Used</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold text-gray-600">Expired</span>
                                    @endif
                                </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $b->donation_date }}</td>
                            <td class="px-6 py-4 text-right text-sm space-x-2">
                                <a href="{{ route('bloods.edit', $b) }}"
                                   class="inline-flex items-center px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium rounded transition ease-in-out duration-150">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('bloods.destroy', $b) }}" class="inline"
                                      onsubmit="return confirm('Delete this record?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 text-xs font-medium rounded transition ease-in-out duration-150">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400 text-sm">
                                No blood donation records found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
