@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Budget</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
            <tr>
                <td>{{ $category->title }}</td>
                <td>{{ $category->budget }}</td>
                <td>{{ $category->year }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-info">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No categories</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
