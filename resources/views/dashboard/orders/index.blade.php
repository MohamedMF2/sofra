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
            <form action="{{ action('OrderController@index')}}" method="get" autocomplete="off">
                <div class="form-group">
                   <input type="search" name="search" placeholder="@lang('lang.search orders by client,restaurant,status,payment,phone,address').." 
                   value="{{request()->input('search')}}" class="form-control" > 
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
            @if (count($orders))
              <table class="table table-hover">
                <tbody>

                  <tr class=" text-danger">
                    <th style="width: 10px">#</th>
                    <th class="text-center">@lang('lang.client')</th>
                    <th class="text-center">@lang('lang.restaurant')</th>
                    {{-- <th class="text-center">@lang('lang.order products')</th> --}}
                    <th class="text-center">@lang('lang.notes')</th>
                    <th class="text-center">@lang('lang.cost')</th>
                    <th class="text-center">@lang('lang.total')</th>
                    <th class="text-center">@lang('lang.delivery')</th>
                    <th class="text-center">@lang('lang.payment')</th>
                    <th class="text-center">@lang('lang.status')</th>
                    <th class="text-center">@lang('lang.phone')</th>
                    <th class="text-center">@lang('lang.address')</th>
                    <th class="text-center">@lang('lang.created at')</th>


                  </tr>
                  @foreach ($orders as $order)
                      <tr>
                         <td> {{ $loop->iteration}} </td>
                         <td  class="text-center"> <a href="{{route('order.show',$order->id)}}"> {{ $order->client->name }}</a> </td>
                         <td  class="text-center">  {{ $order->restaurant->name }} </td>
                           
                         <td  class="text-center">  {{ $order->notes}} </td>
                         <td class="text-center">{{ $order->cost}}</td>
                         <td  class="text-center">{{ $order->total}}</td>
                         <td  class="text-center">{{ $order->restaurant->delivery}}</td>
                         <td  class="text-center">{{ $order->payment}}</td>
                         <td  class="text-center">{{ $order->status}}</td>
                         <td  class="text-center">{{ $order->phone}}</td>
                         <td  class="text-center">{{ $order->address}}</td>
                         <td  class="text-center">{{ $order->created_at}}</td>

                          
                        </tr>
                  @endforeach
                </tbody>
              </table>    
              {{ $orders->links()}}

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
  