<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index() {
        // $expenses = Expense::with('category')->get();
        // return view('expenses.index', compact('expenses'));
        $categories = Category::with('expenses')->get();
        return view('expenses.index', compact('categories'));
    }

    public function create() {
        $categories = Category::all();
        return view('expenses.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'month' => 'required|integer',
            'year' => 'required|integer'
        ]);

        Expense::create($request->all());
        return redirect()->route('expenses.index')->with('success', 'Expense added successfully.');
    }

    public function edit(Expense $expense) {
        $categories = Category::all();
        return view('expenses.edit', compact('expense', 'categories'));
    }

    public function update(Request $request, Expense $expense) {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric',
            'description' => 'required|string|max:255',
            'month' => 'required|integer',
            'year' => 'required|integer'
        ]);

        $expense->update($request->all());
        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense) {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
