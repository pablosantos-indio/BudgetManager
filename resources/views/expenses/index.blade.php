@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Expenses - {{ $currentMonth }} {{ $currentYear }}</h1>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">Add Expense</a>
    <a href="{{ route('expenses.index', ['month' => $previousMonth, 'year' => $previousYear]) }}" class="btn btn-secondary">Previous Month</a>
    <a href="{{ route('expenses.index', ['month' => $nextMonth, 'year' => $nextYear]) }}" class="btn btn-secondary">Next Month</a>

    @foreach ($categories as $category)
    <div class="mt-4">
        <h3>{{ $category->title }} (Budget: {{ number_format($category->budget, 2) }})</h3>
        <div class="progress">
            @php
            $totalSpent = $category->expenses->sum('amount');
            $percentSpent = ($totalSpent / $category->budget) * 100;
            $progressClass = $percentSpent < 100 ? 'bg-success' : ($percentSpent == 100 ? 'bg-warning' : 'bg-danger');
            @endphp
            <div class="progress-bar {{ $progressClass }}" role="progressbar" style="width: {{ $percentSpent }}%" aria-valuenow="{{ $percentSpent }}" aria-valuemin="0" aria-valuemax="100">{{ number_format($totalSpent, 2) }} of {{ number_format($category->budget, 2) }}</div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($category->expenses as $expense)
                <tr>
                    <td>{{ $expense->description }}</td>
                    <td>{{ number_format($expense->amount, 2) }}</td>
                    <td>
                        <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this expense?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No expenses for this category</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endforeach
</div>
@endsection
