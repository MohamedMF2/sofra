@extends('layouts.app')

@section('page_title', __('lang.orders'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
          @include('flash::message')
       

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
            @if (count($offers))
              <table class="table table-hover">
                <tbody>

                  <tr class=" text-danger">
                    <th style="width: 10px">#</th>
                    <th  class="text-center">@lang('lang.offer name')</th>
                    <th class="text-center">@lang('lang.restaurant')</th>
                    <th class="text-center">@lang('lang.image')</th>
                    <th class="text-center">@lang('lang.description')</th>
                    <th class="text-center">@lang('lang.start date')</th>
                    <th class="text-center">@lang('lang.end date')</th>
                    <th class="text-center">@lang('lang.delete')</th>


                  </tr>
                  @foreach ($offers as $offer)
                      <tr>
                         <td> {{ $offer->id}} </td>
                         <td  class="text-center">  {{ $offer->name }} </td>
                         <td  class="text-center">  {{ $offer->restaurant_id }} </td>
                         <td  class="text-center">  {{ $offer->image }} </td>
                         <td  class="text-center">  {{ $offer->description }} </td>
                         <td  class="text-center">  {{ $offer->start }} </td>
                         <td  class="text-center">  {{ $offer->end }} </td>
                        
                         <td  class="text-center">
                           

                            
                            {!! Form::open(['url'=>route('offer.destroy',['id'=>$offer->id]),'method'=>'delete' ]) !!}
                            {!!Form::button('<i class="fa fa-trash-o" ></i>' , ['type' => 'submit','class' => 'btn btn-danger btn-lg'] )!!}
                            {!! Form::close() !!}

                          </td>
                          
                        </tr>
                  @endforeach
                </tbody>
              </table>    
              {{ $offers->links()}}

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
  