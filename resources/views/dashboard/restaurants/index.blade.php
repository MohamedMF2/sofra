@extends('layouts.app')

@section('page_title', __('lang.restaurants'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
          @include('flash::message')


            <h3 class="box-title">  </h3>
            <form action="{{ action('RestaurantController@index')}}" method="get" autocomplete="off">
                <div class="form-group">
                   <input type="search" name="search" placeholder="@lang('lang.search restaurants by name,city,district,category,phone,email').." value="{{request()->input('search')}}" class="form-control" > 
                   <span class="text-danger"> {{ $errors->first('search')}}</span>
                </div>
                @csrf
              </form>
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
            @if (count($restaurants))
              <table class="table table-hover">
                <tbody>

                  <tr class=" text-danger">
                    <th style="width: 10px">#</th>
                    <th class="text-center">@lang('lang.restaurant')</th>
                    <th class="text-center">@lang('lang.image')</th>
                    <th class="text-center">@lang('lang.category')</th>
                    <th class="text-center">@lang('lang.city')</th>
                    <th class="text-center">@lang('lang.change state')</th>
                    <th class="text-center">@lang('lang.delete')</th>


                  </tr>
                  @foreach ($restaurants as $restaurant)
                      <tr>
                         <td> {{ $loop->iteration}} </td>
                         <td  class="text-center"> <a href="{{route('restaurant.show',$restaurant->id)}}"> {{ $restaurant->name }}</a> </td>
                         <td  class="text-center">  {{ $restaurant->image }} </td>
                         <td  class="text-center">
                            @foreach ($restaurant->categories as $object)
                               {{ $object->name }}
                           @endforeach </td>

                         <td  class="text-center">  {{ $restaurant->district->city->name}}
                         </td>
                         <td class="text-center">
                          @if($restaurant->activated)
                       <a href="{{url(route('restaurant.deActive',$restaurant->id))}}" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> إيقاف</a>
                          @else
                              <a href="{{url(route('restaurant.active',$restaurant->id))}}" class="btn btn-xs btn-success"><i class="fa fa-check"></i> تفعيل</a>
                          @endif
                       </td>
                        
                         <td  class="text-center">
                           

                            
                            {!! Form::open(['url'=>route('restaurant.destroy',['id'=>$restaurant->id]),'method'=>'delete' ]) !!}
                            {!!Form::button('<i class="fa fa-trash-o" ></i>' , ['type' => 'submit','class' => 'btn btn-danger btn-lg'] )!!}
                            {!! Form::close() !!}

                          </td>
                          
                        </tr>
                  @endforeach
                </tbody>
              </table>    
              {{ $restaurants->links()}}

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
  