@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Expenses</h1>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">Add Expense</a>

    @foreach ($categories as $category)
    <div class="mt-4">
        <h2>{{ $category->title }} (Budget: {{ $category->budget }})</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($category->expenses as $expense)
                <tr>
                    <td>{{ $expense->description }}</td>
                    <td>{{ $expense->amount }}</td>
                    <td>{{ $expense->month }}</td>
                    <td>{{ $expense->year }}</td>
                    <td>
                        <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('expenses.destroy', $expense) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No expenses</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @endforeach
</div>
@endsection
