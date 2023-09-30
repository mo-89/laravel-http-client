@extends('layouts.app')

@section('content')
<h2>Create Customer</h2>
<form action="{{ route('customers.store') }}" method="post">
    @csrf
    <div>
        <label>Name:</label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label>Age:</label>
        <input type="number" name="age" required>
    </div>
    <div>
        <label>Memo:</label>
        <textarea name="memo"></textarea>
    </div>
    <div>
        <button type="submit">Create</button>
    </div>
</form>
@endsection
