@extends('layouts.admin')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <form action="{{route('admin.products.update', compact('product'))}}" method="post">
                @method('put')
                @csrf
                <input type="text" name="name" placeholder="name" value="{{$product->name}}">
                <input type="text" name="price" placeholder="price" value="{{$product->price}}">
                <input type="text" name="description" placeholder="description" value="{{$product->description}}">
                <select name="active" id="active">
                    <option value="0" >disabled</option>
                    <option value="1">active</option>
                </select>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
@endsection
