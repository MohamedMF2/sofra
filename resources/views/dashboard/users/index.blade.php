@extends('layouts.app')

@section('page_title',__('lang.users'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <a href="{{url(route('user.create'))}}">
                <button class="btn btn-primary"> <i class="fa fa-plus"></i> @lang('lang.new user')  </button>
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
            @if ($users)
              <table class="table table-bordered">
                <tbody>

                  <tr>
                    <th style="width: 10px">#</th>
                    <th  class="text-center">@lang('lang.username') </th>
                    <th  class="text-center">@lang('lang.email')  </th>
                    <th  class="text-center">@lang('lang.role') </th>
                    <th class="text-center">@lang('lang.edit')</th>
                    <th class="text-center">@lang('lang.delete')</th>

                  </tr>
                  @foreach ($users as $user)
                      <tr>
                         <td  class="text-center"> {{ $loop->iteration}} </td>
                         <td  class="text-center">  {{ $user->name }}  </td>
                      <td  class="text-center"> {{ $user->email}}</td>
                     <td class="text-center">  
                       @foreach ($user->roles as $role)
                        <li>{{ $role->name}}</li>
                      @endforeach 
                     </td>
                         <td  class="text-center"> 
                           <a href="{{ url(route('user.edit',$user->id)) }}" class="btn btn-lg btn-success"><i class="fa fa-edit"></i> </a>
                         </td>
                         <td  class="text-center">
                            <form action="{{action('UserController@destroy',$user->id)}}" method="post">
                              @method('DELETE')
                              @csrf
                              <button type="submit" class="btn btn-lg btn-danger"><i class=" fa fa-trash-o"></i></button>
                            </form>
                          </td>

                       
                          

                        </tr>
                  @endforeach
                 
                </tbody>
              </table>    
              {{ $users->links()}}
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
  