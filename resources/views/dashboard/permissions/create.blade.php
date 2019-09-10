@extends('layouts.app')
@inject('perm', 'Spatie\Permission\Models\Permission')

@section('page_title',__('lang.create new permission'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   @include('flash::message')
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                     <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
          <form action="{{ action('PermissionController@store') }}" method="post"  autocomplete="off">        
              <div class="form-group">
                <label for="my-input">@lang('lang.permission name')</label>
              <input id="my-input" class="form-control" type="text" name="name" placeholder=" Enter permission's name" value="{{old('name')}}">
                <span class=" text-danger"> {{ $errors->first('name') }}</span>
              </div>

              <div class="form-group">
                  <label for="my-image">@lang('lang.guard name')</label>
                  <input id="my-guard_name" class="form-control" type="text" name="guard_name" placeholder=" Enter permission's guard name"value="{{old('guard_name')}}">
                      <span class=" text-danger"> {{ $errors->first('guard_name') }}</span>
                </div>
                                   
              <button type="submit" class="btn btn-primary btn-sm" ><i class="fa fa-plus"></i> @lang('lang.add')  </button>
            
            @csrf
          </form>
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  