@extends('layouts.app')
{{-- @inject('role', 'App\Role') --}}

@section('page_title',__('lang.edit user'))
                   
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
          
          <form action="{{ action('UserController@update',$user->id) }}" method="post" autocomplete="off">        
            @method('PUT')

            <div class="form-group">
                <label for="my-input">@lang('lang.name')</label>
              <input id="my-input" class="form-control" type="text" name="name" placeholder=" Enter user's name" value="{{$user->name}}">
                <span class=" text-danger"> {{ $errors->first('name') }}</span>
              </div>

             

              <div class="form-group">
                <label for="my-text">@lang('lang.email')</label>
                <input id="my-input" class="form-control" type="text" name="email" placeholder=" Enter user's email" value="{{$user->email}}">

                <span class=" text-danger"> {{ $errors->first('email') }}</span>
              </div>

              <div class="form-group">
                  <label for="my-text">@lang('lang.password')</label>
                  <input id="my-input" class="form-control" type="password" name="password" placeholder=" Enter user's password" >
                  <span class=" text-danger"> {{ $errors->first('password') }}</span>
              </div>
                    
              <div class="form-group">
                  <label for="my-text">@lang('lang.confirm password') </label>
                  <input id="my-input" class="form-control" type="password" name="password_confirmation" placeholder=" Enter user's password" >
                  <span class=" text-danger"> {{ $errors->first('password') }}</span>
              </div>
              
              <?php 
                // $roles=$role->pluck('display_name','id')->toArray();
              ?> 
              
              {{-- <div class="form-group">
                <label for="my-input">@lang('lang.role')</label>
                <select name="roles_list[]" id="my-input" class="form-control" multiple>
                  <option  disabled> @lang('lang.choose user Role')</option>
                  @foreach ($roles as $id=>$name)
                    <option value="{{$id}}"> {{ $name}} </option>
                  @endforeach
                </select>
                <span class=" text-danger"> {{ $errors->first('roles_list') }}</span>
              </div> --}}

              <button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i> @lang('lang.save') </button>
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
  