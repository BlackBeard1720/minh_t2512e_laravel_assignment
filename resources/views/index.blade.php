<x-layout>
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-800">Account List</h2>

        <a href="{{ route('accounts.create') }}"
           class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Create Account
        </a>
    </div>

    <form action="{{ route('accounts.index') }}" method="GET"
          class="mb-6 grid grid-cols-1 gap-4 rounded bg-white p-5 shadow md:grid-cols-5">
        <div>
            <label class="mb-1 block text-sm font-medium text-gray-700">Search</label>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Name, email or phone"
                class="w-full rounded border border-gray-300 px-3 py-2"
            >
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-gray-700">Minimum Balance</label>
            <input
                type="number"
                name="min_balance"
                value="{{ request('min_balance') }}"
                placeholder="10000000"
                class="w-full rounded border border-gray-300 px-3 py-2"
            >
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-gray-700">From Date</label>
            <input
                type="date"
                name="from_date"
                value="{{ request('from_date') }}"
                class="w-full rounded border border-gray-300 px-3 py-2"
            >
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-gray-700">To Date</label>
            <input
                type="date"
                name="to_date"
                value="{{ request('to_date') }}"
                class="w-full rounded border border-gray-300 px-3 py-2"
            >
        </div>

        <div class="flex items-end gap-2">
            <button type="submit"
                    class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                Filter
            </button>

            <a href="{{ route('accounts.index') }}"
               class="rounded bg-gray-200 px-4 py-2 text-gray-800 hover:bg-gray-300">
                Reset
            </a>
        </div>
    </form>

    <div class="overflow-x-auto rounded bg-white shadow">
        <table class="min-w-full border-collapse text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2 text-left">No.</th>
                    <th class="border px-3 py-2 text-left">ID</th>
                    <th class="border px-3 py-2 text-left">Account Number</th>
                    <th class="border px-3 py-2 text-left">Full Name</th>
                    <th class="border px-3 py-2 text-left">Email</th>
                    <th class="border px-3 py-2 text-left">Phone</th>
                    <th class="border px-3 py-2 text-right">Balance</th>
                    <th class="border px-3 py-2 text-left">Status</th>
                    <th class="border px-3 py-2 text-left">Created At</th>
                    <th class="border px-3 py-2 text-left">Updated At</th>
                    <th class="border px-3 py-2 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($accounts as $account)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-3 py-2">
                            {{ $loop->iteration + ($accounts->currentPage() - 1) * $accounts->perPage() }}
                        </td>
                        <td class="border px-3 py-2">{{ $account->id }}</td>
                        <td class="border px-3 py-2">{{ $account->account_number }}</td>
                        <td class="border px-3 py-2">{{ $account->full_name }}</td>
                        <td class="border px-3 py-2">{{ $account->email }}</td>
                        <td class="border px-3 py-2">{{ $account->phone }}</td>
                        <td class="border px-3 py-2 text-right">
                            {{ number_format($account->balance, 0, ',', '.') }}đ
                        </td>
                        <td class="border px-3 py-2">
                            @php
                                $statusClass = match ($account->status) {
                                    'active' => 'bg-green-100 text-green-700',
                                    'inactive' => 'bg-yellow-100 text-yellow-700',
                                    'banned' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp

                            <span class="rounded px-2 py-1 text-xs font-medium {{ $statusClass }}">
                                {{ ucfirst($account->status) }}
                            </span>
                        </td>
                        <td class="border px-3 py-2">{{ $account->created_at }}</td>
                        <td class="border px-3 py-2">{{ $account->updated_at }}</td>
                        <td class="border px-3 py-2">
                            <div class="flex gap-2">
                                <a href="#"
                                   class="rounded bg-yellow-400 px-3 py-1 text-white hover:bg-yellow-500">
                                    Edit
                                </a>

                                <form action="{{ route('accounts.destroy', $account->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this account?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="rounded bg-red-600 px-3 py-1 text-white hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="border px-3 py-6 text-center text-gray-500">
                            No accounts found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $accounts->links() }}
    </div>
</x-layout>