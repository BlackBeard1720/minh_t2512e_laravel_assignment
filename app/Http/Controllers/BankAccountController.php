<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = BankAccount::findOrFail($id);
        $account->delete();

        return back()->with('success', 'Account deleted!');
    }
}
