@extends('layouts.app')

@section('page_title',  'Type')

@section('page_header')
    <h1 class="page-title">
        {{ 'Type' }}
    </h1>
@stop

@section('content')

    <a href="{{ route('type.create') }}" class="btn btn-success btn-add-new">
        <i class="fas fa-plus"></i> <span>Create</span>
    </a>
    <div class="mt-5">
        <div class="table-responsive">
            <table class="table ">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr data-status="{{$item->id}}">
                        <td>{{$item->name}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('type.edit',$item->id)}}" type="button" class="btn btn-info">
                                    edit
                                </a>
                                <a href="{{route('type.destroy',$item->id)}}" data-toggle="modal"
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
