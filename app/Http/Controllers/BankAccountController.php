<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function index(Request $request)
    {
        $query = BankAccount::query();

        if($request->filled('search')){
            $search = $request->input('search');
            
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if($request->filled('min_balance')){
            $query->where('balance', '>=', $request->input('min_balance'));
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->input('from_date'));
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->input('to_date'));
        }

        $accounts = $query->latest()->paginate(10)->withQueryString();

        return view('index', ['accounts' => $accounts]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'account_number' => 'required|digits:10|unique:bank_accounts,account_number',
            'full_name' => 'required',
            'email' => 'required|email|max:255|unique:bank_accounts,email',
            'phone' => 'required|max:20',
            'balance' => 'required|numeric|min:10000|max:500000000',
            'status' => 'required|in:active,inactive,banned'
        ]);

        BankAccount::create($data);
        return to_route('accounts.index')->with('success', 'Account created successfully.');
    }

    public function edit(string $id)
    {
        $account = BankAccount::findOrFail($id);

        return view('edit', ['account' => $account]);
    }

    public function update(Request $request, string $id)
    {
        $account = BankAccount::findOrFail($id);

        $data = $request->validate([
            'account_number' => 'required|digits:10|unique:bank_accounts,account_number,' . $account->id,
            'full_name' => 'required',
            'email' => 'required|email|max:255|unique:bank_accounts,email,' . $account->id,
            'phone' => 'required|max:20',
            'balance' => 'required|numeric|min:10000|max:500000000',
            'status' => 'required|in:active,inactive,banned',
        ]);

        $account->update($data);

        return to_route('accounts.index')->with('success', 'Account updated successfully.');
    }

    public function destroy(string $id)
    {
        $account = BankAccount::findOrFail($id);
        $account->delete();

        return back()->with('success', 'Account deleted successfully!');
    }
}
