@extends('layouts.app')

@section('page_title',__('lang.create new role'))
                 
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
          <form action="{{ action('RoleController@store') }}" method="post"  autocomplete="off">        
              <div class="form-group">
                <label for="my-input">@lang('lang.role name')</label>
              <input id="my-input" class="form-control" type="text" name="name" placeholder=" Enter role's name" value="{{old('name')}}">
                <span class=" text-danger"> {{ $errors->first('name') }}</span>
              </div>

              <div class="form-group">
                  <label for="my-image">@lang('lang.guard name')</label>
                  <input id="my-guard_name" class="form-control" type="text" name="guard_name" placeholder=" Enter role's guard name"value="{{old('guard_name')}}">
                      <span class=" text-danger"> {{ $errors->first('guard_name') }}</span>
                </div>

            

              <div class="form-group">
                <label >@lang('lang.permissions')</label><br>
                <input id="select-all" type="checkbox"><label for='select-all'>@lang('lang.select all')</label>
               <div class="row">
                  @foreach ($permissions as $permission)
                    <div class="col-sm-3">
                    <input type="checkbox" name="permissions[]" value="{{$permission->id}}">{{$permission->name}}
                    </div>
                  @endforeach
                </div>
                <span class=" text-danger"> {{ $errors->first('permissions') }}</span>

              </div>
                                   
              <button type="submit" class="btn btn-primary btn-lg" ><i class="fa fa-plus"></i> @lang('lang.add')  </button>
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
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  