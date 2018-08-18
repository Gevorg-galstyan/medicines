@extends('layouts.app')

@section('page_title', ((!is_null($data->getKey()) ? 'edit' : 'add' ) .  'Tablet'))

@section('page_header')
    <h1 class="page-title">
        {{ ((!is_null($data->getKey()) ? 'Edit ' : 'Add ' ) .  'Tablet') }}
    </h1>
@stop


@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                          class="form-edit-add"
                          action="{{!is_null($data->getKey()) ? route('tablet.update', $data->slug)  : route('tablet.store')}}"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                    @if(!is_null($data->getKey()))
                        {{ method_field("PUT") }}
                    @endif

                    <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body ">

                            <!-- Adding / Editing -->

                            <div class="row">
                                <div class="form-group  col-md-4 ">
                                    <label for="type">Type</label>

                                    <select class="custom-select form-control" id="type" name="type" required>
                                        @foreach($types as $type)
                                            <option
                                                value="{{$type->id}}" {{ $type->id == $data->type_id ? 'selecteg' : ''}}>{{$type->name}}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group  col-md-4 ">
                                    <label class="" for="manufacturer">Manufacturer</label>

                                    <select class="custom-select form-control" id="manufacturer" name="manufacturer"
                                            required>
                                        @foreach($manufacturers as $manufacturer)
                                            <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group  col-md-4 ">
                                    <label for="name">Name</label>

                                    <input required type="text" class="form-control"
                                           name="name"
                                           placeholder="Name"
                                           value="@if(isset($data->name)){{ old('name', $data->name) }}@else{{ old('name')}}@endif">
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group  col-md-6 ">
                                    <label for="description">Description</label>

                                    <textarea required rows="10" class="form-control richTextBox" name="description"
                                              id="description"
                                              required>@if(isset($data->description)){{ old('description', $data->description) }}@else{{old('description')}}@endif</textarea>

                                </div>

                                <div class="form-group  col-md-3 ">
                                    @if(isset($data->image))
                                        <img src="{{asset('storage/'.$data->image)}}"
                                             style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                    <label for="image">Image</label>
                                    <div class="input-group">

                                        <div class="custom-file">
                                            <input type="file" {{!is_null($data->getKey()) ? ''  : 'required'}}
                                            class="custom-file-input"
                                                   id="image"
                                                   accept="image/*"
                                                   name="image"
                                                   aria-describedby="image">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group  col-md-3 ">
                                    <label for="watermark">Watermark</label>
                                    <select class="form-control my-select2" name="watermark">
                                        <option value="">Select...</option>
                                        @foreach($watermarks as $watermark)
                                            <option value="{{$watermark->image}}">
                                                {{asset('storage/'.$watermark->image)}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit"
                                    class="btn btn-primary save mt-3">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@stop

