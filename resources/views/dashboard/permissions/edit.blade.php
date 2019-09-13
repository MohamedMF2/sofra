@extends('layouts.app')
@inject('perm', 'App\Permission')

@section('page_title',__('lang.edit permission'))
                  
@section('content')     
  <!-- Main content -->
  <section class="content">
   
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

          <!---------------------------- Form  ------------------------------------>
          
          <form action="{{ action('PermissionController@update',$permission->id) }}" method="post" autocomplete="off">        
            @method('PUT')
              <div class="form-group">
                <label for="my-name">@lang('lang.name')</label>
                 <input id="my-name" class="form-control" type="text" name="name" value="{{$permission->name}}">
                <span class=" text-danger"> {{ $errors->first('name') }}</span>
              </div>

              <div class="form-group">
                  <label for="my-guard">@lang('lang.guard name')</label>
                  <input id="my-guard" class="form-control" type="text" name="guard_name"  value="{{$permission->guard_name}}">
                      <span class=" text-danger"> {{ $errors->first('guard_name') }}</span>
                </div>

                <div class="form-group">
                  <label for="my-route">@lang('lang.route')</label>
                  <input id="my-route" class="form-control" type="text" name="route"  value="{{$permission->route}}">
                      <span class=" text-danger"> {{ $errors->first('route') }}</span>
                </div>

              

                                   
              
              <button type="submit" class="btn btn-primary" > @lang('lang.save') </button>
             
            @csrf
          </form>
          <!----------------------------  End Of Form  ------------------------------------>

        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  