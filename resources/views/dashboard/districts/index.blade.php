@extends('layouts.app')

@section('page_title', __('lang.city').' '. $city ->name.'/'.__('lang.districts'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   
    <!-- Default box -->
    <div class="box">
      @include('flash::message')
      <div class="box-header with-border">
        <a href="{{url(route('city.district.create',$city_id))}}" type="button" class="btn btn-info btn-lg"> <i class="fa fa-plus"></i> @lang('lang.add new district')</a>

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
            @if (count($districts))
            
              <table class="table table-hover ">
              <thead class="thead-dark">

                  <tr class='text-danger' >
                    <th style="width: 10px" >#</th>
                    <th  class="text-center">@lang('lang.district name')</th>
                    <th class="text-center">@lang('lang.edit')</th>
                    <th class="text-center">@lang('lang.delete')</th>
                  </tr>
                </thead>
                  <tbody>

                  @foreach ($districts as $district)
                      <tr>
                         <td> {{ $loop->iteration}} </td>
                         <td  class="text-center">  {{ $district->name }} </td>
                         <td  class="text-center"> 
                           <a href="{{ url(route('city.district.edit',[$district->city_id, $district->id] )) }}" class="btn btn-lg btn-success"><i class="fa fa-edit"></i> </a>
                         </td>
                         <td  class="text-center">
                            <form action="{{action('CityDistrictController@destroy',[$district->city_id, $district->id])}}" method="post">
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
  