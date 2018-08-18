@extends('layouts.app')

@section('page_title', ((!is_null($data->getKey()) ? 'edit' : 'add' ) .  'Watermark'))

@section('page_header')
    <h1 class="page-title">
        {{ ((!is_null($data->getKey()) ? 'Edit ' : 'Add ' ) .  'Watermark') }}
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
                          action="{{!is_null($data->getKey()) ? route('watermark.update', $data->id)  : route('watermark.store')}}"
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

                                <div class="form-group  col-md-6 ">
                                    @if(isset($data->image))
                                        <img src="{{asset('storage/'.$data->image)}}"
                                             style="max-width:50px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                    @endif
                                    <label for="image">Image</label>
                                    <div class="input-group">

                                        <div class="custom-file">
                                            <input type="file" required
                                            class="custom-file-input"
                                                   id="image"
                                                   accept="image/*"
                                                   name="image"
                                                   aria-describedby="image">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                        </div>

                                    </div>

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

