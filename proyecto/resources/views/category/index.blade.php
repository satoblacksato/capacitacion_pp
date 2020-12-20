@extends('layouts.custom')
@section('title','Categorias')
@section('body')
    <h1>@lang('admin.category')</h1>
    <br/>
    <a class="btn btn-sm btn-primary" href="{{route('category.create')}}">@lang('admin.btn_create',['name'=>__('admin.category')])</a>
    <br/>
    <table class="table table-sm">
        <thead>
            <th>@lang('admin.ID')</th>
            <th>@lang('admin.NOMBRE')</th>
            <th>@lang('admin.DESCRIPCION')</th>
            <th>@lang('admin.ACCIONES')</th>
        </thead>
        <tbody>
           @forelse($categories as $category)
               <tr>
                   <td>{{$category->id}}</td>
                   <td>{{$category->name}}</td>
                   <td>{{$category->description}}</td>
                   <td>
                       <x-links-actions r-delete="category.destroy"
                                        r-edit="category.edit"
                                        obj-key="{{$category->getRouteKey()}}"></x-links-actions>
                   </td>
               </tr>
           @empty
            <tr>
                <td colspan="4">NO HAY CATEGORIAS INGRESADAS</td>
            </tr>
           @endforelse

        </tbody>
    </table>
    {!! $categories->render() !!}
@endsection
