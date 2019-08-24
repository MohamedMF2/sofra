@extends('layouts.app')

@section('page_title',__('lang.categories'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   
    <!-- Default box -->
     <div class="box">
         <div class="box-header with-border">
            @include('flash::message')

         <a href="{{route('category.create')}}">
                <button class="btn btn-lg btn-info"> <i class="fa fa-plus"></i>{{__('lang.add category')}} </button>
            </a> <br><br><br>

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
            @if (count($categories))
              <table class="table table-hover">
                <thead class="text-danger">
                  <tr>
                    <th style="width: 10px">#</th>
                    <th  class="text-center"> @lang('lang.category name') </th>
                    <th class="text-center"> @lang('lang.edit')</th>
                    <th class="text-center"> @lang('lang.delete')</th>

                  </tr>
                </thead>
                <tbody>

                  @foreach ($categories as $category)
                      <tr>
                         <td> {{ $loop->iteration}} </td>
                      <td  class="text-center">  {{ $category->name }} </td>
                         <td  class="text-center"> 
                           <a href="{{ url(route('category.edit',$category->id)) }}" class="btn btn-lg btn-success"><i class="fa fa-edit"></i> </a>
                         </td>
                         <td  class="text-center">
                            <form action="{{action('CategoryController@destroy',$category->id)}}" method="post">
                              @method('DELETE')
                              @csrf
                              <button type="submit" class="btn btn-lg btn-danger"><i class=" fa fa-trash-o"></i></button>
                            </form>
                          </td>

                        </tr>
                  @endforeach
                 
                </tbody>
              </table>    

            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">nodata</h4>
                </div>
            @endif
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  