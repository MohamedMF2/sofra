@extends('layouts.app')
@inject('perm', 'App\Permission')

@section('page_title',__('lang.edit role'))
                  
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
          
          <form action="{{ action('RoleController@update',$role->id) }}" method="post" autocomplete="off">        
            @method('PUT')
              <div class="form-group">
                <label for="my-input">@lang('lang.name')</label>
                 <input id="my-input" class="form-control" type="text" name="name" value="{{$role->name}}">
                <span class=" text-danger"> {{ $errors->first('name') }}</span>
              </div>

              <div class="form-group">
                  <label for="my-image">@lang('lang.guard name')</label>
                  <input id="my-image" class="form-control" type="text" name="guard_name" placeholder=" Enter role's guard name" value="{{$role->guard_name}}">
                      <span class=" text-danger"> {{ $errors->first('guard_name') }}</span>
                </div>

              

                                   
              <div class="form-group">
                  <label >@lang('lang.permissions')</label><br>
                  <input id="select-all" type="checkbox"><label for='select-all'>@lang('lang.select all')</label>
                  <div class="row">
                      @foreach ($perm->all() as $permission)
                      <div class="col-sm-3">
                        <input type="checkbox" name="permissions[]" value="{{$permission->id}}" 
                        @if ($role->hasPermissionTo($permission))checked 
                        @endif>
                        {{$permission->name}}

                      </div>
                    @endforeach
                  </div>
                </div>
              <button type="submit" class="btn btn-primary" > @lang('lang.save') </button>
              @push('scripts')
              <script> 
                 $("#select-all").click(function(){
                  $("input[type=checkbox]").prop('checked',
                  $(this).prop('checked'));
                 });
              </script>
              @endpush
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
  