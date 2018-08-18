@extends('layouts.app')

@section('page_title', 'Tablet')

@section('page_header')
    <h1 class="page-title">
        {{'Tablet' }}
    </h1>
@stop
@section('content')

    <a href="{{ route('tablet.create') }}" class="btn btn-success btn-add-new">
        <i class="fas fa-plus"></i> <span>Create</span>
    </a>
    <div class="mt-5">
        <div class="table-responsive">
            <table class="table ">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Manufacturer</th>
                    <th scope="col">Image</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr data-status="{{$item->id}}">
                        <td>{{$item->name}}</td>
                        <td>{{$item->type->name}}</td>
                        <td>{{$item->manufacturer->name}}</td>
                        <td><img src="{{asset('storage/'.$item->image)}}"
                                 style="max-width:100px; height:100px; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;"></td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('tablet.edit',$item->slug)}}" type="button" class="btn btn-info">
                                    edit
                                </a>
                                <a href="{{route('tablet.destroy',$item->slug)}}" data-toggle="modal"
                                   data-tr="{{$item->id}}"
                                   data-target="#confirm-delete-modal"
                                   type="button" class="btn btn-danger delete">
                                    delete
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$data->links()}}
        </div>
    </div>
    @include('layouts.modal-delete')
@stop
