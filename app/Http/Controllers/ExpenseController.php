<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request) {
        $currentMonth = $request->input('month', now()->month);
        $currentYear = $request->input('year', now()->year);

        $previousMonth = ($currentMonth == 1) ? 12 : $currentMonth - 1;
        $previousYear = ($currentMonth == 1) ? $currentYear - 1 : $currentYear;

        $nextMonth = ($currentMonth == 12) ? 1 : $currentMonth + 1;
        $nextYear = ($currentMonth == 12) ? $currentYear + 1 : $currentYear;

        $categories = Category::with(['expenses' => function ($query) use ($currentMonth, $currentYear) {
            $query->where('month', $currentMonth)->where('year', $currentYear)->orderBy('month', 'desc');
        }])->where('year', $currentYear)->get();

        return view('expenses.index', compact('categories', 'currentMonth', 'currentYear', 'previousMonth', 'previousYear', 'nextMonth', 'nextYear'));
    }

    public function create() {
        $categories = Category::all();
        return view('expenses.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric',
            'description' => 'required|string|max:255',
            'month' => 'required|integer'
        ]);

        $categoryYear = Category::findOrFail($request->category_id)->year;

        Expense::create(array_merge($request->all(), ['year' => $categoryYear]));

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
            'description' => 'required|string',
            'month' => 'required|integer'
        ]);

        $categoryYear = Category::findOrFail($request->category_id)->year;

        $expense->update(array_merge($request->all(), ['year' => $categoryYear]));

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense) {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
