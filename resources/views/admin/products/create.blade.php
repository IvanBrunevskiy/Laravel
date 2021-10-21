@extends('layouts.admin')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="name" placeholder="name">
                <input type="text" name="price" placeholder="price">
                <input type="text" name="description" placeholder="description">
                <input type="file" name="photo">
                <select name="active" id="active">
                    <option value="0">disabled</option>
                    <option value="1">active</option>
                </select>
                <button type="submit">Save</button>
            </form>
        </div>
    </div>
@endsection
