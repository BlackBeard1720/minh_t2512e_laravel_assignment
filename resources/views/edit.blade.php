<x-layout>
    <div class="mx-auto max-w-2xl rounded bg-white p-6 shadow">
        <h2 class="mb-6 text-xl font-bold text-gray-800">Edit Account</h2>

        @if ($errors->any())
            <div class="mb-5 rounded border border-red-300 bg-red-100 px-4 py-3 text-red-800">
                <strong>Please check the errors below.</strong>
            </div>
        @endif

        <form action="{{ route('accounts.update', $account->id) }}" method="POST" novalidate class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="account_number" class="mb-1 block font-medium text-gray-700">
                    Account Number
                </label>

                <input
                    type="text"
                    name="account_number"
                    id="account_number"
                    value="{{ old('account_number', $account->account_number) }}"
                    class="w-full rounded border border-gray-300 px-3 py-2"
                >

                @error('account_number')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="full_name" class="mb-1 block font-medium text-gray-700">
                    Full Name
                </label>

                <input
                    type="text"
                    name="full_name"
                    id="full_name"
                    value="{{ old('full_name', $account->full_name) }}"
                    class="w-full rounded border border-gray-300 px-3 py-2"
                >

                @error('full_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="mb-1 block font-medium text-gray-700">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', $account->email) }}"
                    class="w-full rounded border border-gray-300 px-3 py-2"
                >

                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="mb-1 block font-medium text-gray-700">
                    Phone Number
                </label>

                <input
                    type="tel"
                    name="phone"
                    id="phone"
                    value="{{ old('phone', $account->phone) }}"
                    class="w-full rounded border border-gray-300 px-3 py-2"
                >

                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="balance" class="mb-1 block font-medium text-gray-700">
                    Balance
                </label>

                <input
                    type="number"
                    name="balance"
                    id="balance"
                    value="{{ old('balance', $account->balance) }}"
                    class="w-full rounded border border-gray-300 px-3 py-2"
                >

                @error('balance')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="mb-1 block font-medium text-gray-700">
                    Status
                </label>

                <select
                    name="status"
                    id="status"
                    class="w-full rounded border border-gray-300 px-3 py-2"
                >
                    <option value="active" @selected(old('status', $account->status) === 'active')>
                        Active
                    </option>

                    <option value="inactive" @selected(old('status', $account->status) === 'inactive')>
                        Inactive
                    </option>

                    <option value="banned" @selected(old('status', $account->status) === 'banned')>
                        Banned
                    </option>
                </select>

                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button
                    type="submit"
                    class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                >
                    Update
                </button>

                <a
                    href="{{ route('accounts.index') }}"
                    class="rounded bg-gray-200 px-4 py-2 text-gray-800 hover:bg-gray-300"
                >
                    Back
                </a>
            </div>
        </form>
    </div>
</x-layout>