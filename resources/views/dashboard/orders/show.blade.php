@extends('layouts.app')


@section('page_title',__('lang.order'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            
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
          <h2>@lang('lang.order details')</h2>
            @if ($products)
              <table class="table table-bordered">
                <tbody>

                  <tr>
                    <th  class="text-center"> @lang('lang.products')</th>
                    <th  class="text-center"> @lang('lang.description')</th>
                    <th  class="text-center"> @lang('lang.quantity')</th>
                    <th  class="text-center"> @lang('lang.price')</th>
                    <th  class="text-center"> @lang('lang.special_order')</th>
                  </tr>
                  
                        @foreach ($order->products as $product)
                          <tr>
                              <td  class="text-center"> {{ $product->name}}  </td>
                            <td  class="text-center"> {{ $product->description}}  </td>
                            <td  class="text-center"> {{ $product->pivot->quantity}} </td>
                            <td  class="text-center"> {{ $product->pivot->price}} </td>     
                            <td  class="text-center"> {{ $product->pivot->special_order}} </td>
                            
                        </tr>                            
                        @endforeach
                 
                </tbody>
              </table>    
              {{$products->links()}}

            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">nodata</h4>
                </div>
            @endif
                <br>


        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  