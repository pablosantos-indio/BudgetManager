@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Expense</h1>
    <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $expense->description }}" maxlength="255" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ $expense->amount }}" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $expense->category_id ? 'selected' : '' }}>{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
