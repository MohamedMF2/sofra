@extends('layouts.app')

@section('page_title',__('lang.edit category'). ' '.$category->name)
                 
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
          <form action=""> </form>
          <!---------------------------- Form  ------------------------------------>
          
          <form action="{{ action('CategoryController@update',$category->id) }}" method="post" autocomplete="off">        
            @method('PUT')
              <div class="form-group">
                <label for="my-input">@lang('lang.name')</label>
              <input id="my-input" class="form-control" type="text" name="name" value="{{$category->name}}">
                <span class=" text-danger"> {{ $errors->first('name') }}</span>

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
  