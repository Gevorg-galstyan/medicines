@extends('layouts.app')

@section('page_title', ((!is_null($data->getKey()) ? 'edit' : 'add' ) .  'Manufacturer'))

@section('page_header')
    <h1 class="page-title">
        <i class="fas fa-industry"></i>
        {{ ((!is_null($data->getKey()) ? 'Edit ' : 'Add ' ) .  'Manufacturer') }}
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
                          action="{{!is_null($data->getKey()) ? route('manufacturer.update', $data->id)  : route('manufacturer.store')}}"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                    @if(!is_null($data->getKey()))
                        {{ method_field("PUT") }}
                    @endif

                    <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            <!-- Adding / Editing -->

                            <div class="form-group  col-md-4 ">
                                <label for="name">Name</label>

                                <input required type="text" class="form-control"
                                       name="name"
                                       placeholder="Name"
                                       value="@if(isset($data->name)){{ old('name', $data->name) }}@else{{ old('name')}}@endif">
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

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;
                    </button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}
                    </h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'
                    </h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger"
                            id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

