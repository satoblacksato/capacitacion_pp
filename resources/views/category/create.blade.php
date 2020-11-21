@extends('layouts.custom')
@section('title','Categorias')
@section('body')
    <h1>@lang('admin.category')</h1>
    <br/>
    <a class="btn btn-sm btn-danger" href="{{route('category.index')}}">
        @lang('admin.btn_cancel')</a>
    <br/>

    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="text-white">Admin</h3>
        </div>
        <div class="card-body">
            {!! Form::open(['route'=>'category.store','files'=>true]) !!}
                <x-name-description-photo></x-name-description-photo>
                <button class="btn btn-primary byn-block" type="submit">@lang('admin.btn_save')</button>
            {!! Form::close() !!}
        </div>
        <div class="card-footer">

        </div>
    </div>

@endsection
