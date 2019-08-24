@extends('layouts.app')

@section('page_title', __('lang.cities'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
          @include('flash::message')
        <a href="{{url(route('city.create'))}}" class="btn btn-info btn-lg"> 
          <i class="fa fa-plus"></i> @lang('lang.add new city')
        </a>

            <h3 class="box-title">  </h3>
                
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
            @if (count($cities))
              <table class="table table-hover">
                <tbody>

                  <tr class=" text-danger">
                    <th style="width: 10px">#</th>
                    <th  class="text-center">@lang('lang.city name')</th>
                    <th class="text-center">@lang('lang.edit')</th>
                    <th class="text-center">@lang('lang.delete')</th>
                    <th class="text-center">@lang('lang.districts')</th>


                  </tr>
                  @foreach ($cities as $city)
                      <tr>
                         <td> {{ $loop->iteration}} </td>
                         <td  class="text-center">  {{ $city->name }} </td>
                         <td  class="text-center"> 
                           <a href="{{ url(route('city.edit',[$city->id] )) }}" class="btn btn-lg btn-success"><i class="fa fa-edit"></i> </a>
                         </td>
                         <td  class="text-center">
                            {{-- <form action="{{action('CityController@destroy',[ $city->id])}}" method="post">
                              @method('DELETE')
                              @csrf
                              <button type="submit" class="btn btn-sm btn-danger"><i class=" fa fa-trash-o"></i></button>
                            </form> --}}

                            
                            {!! Form::open(['url'=>route('city.destroy',['id'=>$city->id]),'method'=>'delete' ]) !!}
                            {!!Form::button('<i class="fa fa-trash-o" ></i>' , ['type' => 'submit','class' => 'btn btn-danger btn-lg'] )!!}
                            {!! Form::close() !!}

                          </td>
                          <td class="text-center">
                            <a href="{{ url(route('city.district.index',$city->id))}}" class="btn btn-primary"> @lang('lang.districts')</a>
                          </td>
                        </tr>
                  @endforeach
                </tbody>
              </table>    
              {{ $cities->links()}}

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
  