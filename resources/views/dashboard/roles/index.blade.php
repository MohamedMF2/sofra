@extends('layouts.app')

@section('page_title',__('lang.roles'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <a href="{{ url(route('role.create')) }}">
                <button class="btn btn-primary" > <i class="fa fa-plus"></i> @lang('lang.new role')  </button>
              </a>  <br><br>
              @include('flash::message')
            

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
            @if ($roles)
              <table class="table table-bordered">
                <tbody>

                  <tr>
                    <th style="width: 10px">#</th>
                    <th  class="text-center">@lang('lang.role name') </th>
                    <th  class="text-center">@lang('lang.guard name')  </th>

                    <th class="text-center">@lang('lang.edit')</th>
                    <th class="text-center">@lang('lang.delete')</th>

                  </tr>
                  @foreach ($roles as $role)
                      <tr>
                         <td  class="text-center"> {{ $loop->iteration}} </td>
                         <td  class="text-center"> {{ $role->name }}   </td>
                      <td  class="text-center"> {{ $role->guard_name}}</td>

                         <td  class="text-center"> 
                           <a href="{{ url(route('role.edit',$role->id)) }}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> </a>
                         </td>
                         <td  class="text-center">
                            <form action="{{action('RoleController@destroy',$role->id)}}" method="post">
                              @method('DELETE')
                              @csrf
                              <button type="submit" class="btn btn-sm btn-danger"><i class=" fa fa-trash-o"></i></button>
                            </form>
                          </td>

                       
                          

                        </tr>
                  @endforeach
                 
                </tbody>
              </table>    

            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">@lang('lang.no data')</h4>
                </div>
            @endif
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  