@extends('layouts.app')
@section('page_title', $city->name . ' City ')
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
        <h3 class="box-title">@lang('lang.add new district')</h3><br>
           

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
          <form action=""></form>
          <form action="{{ action('CityDistrictController@store',$city_id) }}" method="post" autocomplete="off">        
              <div class="form-group">
                <label for="my-input">@lang('lang.name')</label>
                <input id="my-input" class="form-control" type="text" name="name" placeholder=" @lang('lang.enter district\'s name')">
                <span class=" text-danger"> {{ $errors->first('name') }}</span>

              </div>
                                   

              <button type="submit" class="btn btn-success btn-lg" ><i class="fa fa-plus"></i> @lang('lang.add') </button>

            @csrf
          </form>

        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  