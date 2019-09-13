@extends('layouts.app')
@inject('role', 'App\Role')

@section('page_title',__('lang.create new user'))
                 
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
          <form action="{{ action('UserController@store') }}" method="post" autocomplete="off">        
           
            <div class="form-group">
                <label for="my-input">@lang('lang.username')</label>
              <input id="my-input" class="form-control" type="text" name="name" placeholder="@lang('lang.enter username')" value="{{old('name')}}">
                <span class=" text-danger"> {{ $errors->first('name') }}</span>
              </div>

             

              <div class="form-group">
                <label for="my-text"> @lang('lang.email')</label>
                <input id="my-input" class="form-control" type="text" name="email" placeholder="@lang('lang.enter email')" value="{{old('email')}}">

                <span class=" text-danger"> {{ $errors->first('email') }}</span>
              </div>

              <div class="form-group">
                  <label for="my-text"> @lang('lang.password')</label>
                  <input id="my-input" class="form-control" type="password" name="password" placeholder="@lang('lang.enter password')" >
                  <span class=" text-danger"> {{ $errors->first('password') }}</span>
              </div>
                    
              <div class="form-group">
                  <label for="my-text"> @lang('lang.confirm password') </label>
                  <input id="my-input" class="form-control" type="password" name="password_confirmation" placeholder="@lang('lang.enter password confirmation')" >
                  <span class=" text-danger"> {{ $errors->first('password') }}</span>
              </div>
              
              <?php 
                $roles=$role->pluck('name','id')->toArray();
              ?> 
              
              <div class="form-group">
                <label for="my-input"> @lang('lang.role')</label>
                <select name="roles[]" id="my-input" class="form-control" multiple>
                  <option  disabled> @lang('lang.choose user role')</option>
                  @foreach ($roles as $id=>$name)
                    <option value="{{$id}}"> {{$name}}</option>
                  @endforeach
                </select>
                <span class=" text-danger"> {{ $errors->first('roles') }}</span>
              </div>

              <button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i> @lang('lang.add') </button>
            @csrf
          </form>
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  