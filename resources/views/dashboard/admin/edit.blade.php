@extends('layouts.app')
@section('page_title',  __('lang.reset password') . auth()->user()->name )
                  
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
          @include('flash::message')

          <!---------------------------- Form  ------------------------------------>
          @if ($user)
           
          <form action="{{ action('AdminController@store')}}" method="post" autocomplete="off">        

            <div class="form-group">
                <label for="my-input">@lang('lang.new password')</label>
                <input id="my-input" class="form-control" type="password" name="password"  placeholder="@lang('lang.enter new password')">
                     <span class=" text-danger"> {{ $errors->first('password') }}</span>
            </div>

            <div class="form-group">
                <label for="my-input">@lang('lang.new password confirmation')</label>
                <input id="my-input" class="form-control" type="password"  name ="password_confirmation" placeholder="@lang('lang.confirm password')">
                     <span class=" text-danger"> {{ $errors->first('password') }}</span>
            </div>
              <button type="submit" class="btn btn-primary" >@lang('lang.save')  </button>
            @csrf
          </form>
          <!----------------------------  End Of Form  ------------------------------------>

          @endif

        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  