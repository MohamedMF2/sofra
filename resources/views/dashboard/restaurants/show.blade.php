@extends('layouts.app')


@section('page_title', $restaurant->name .' '.__('lang.\'s restaurant'))
                 
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
            @if ($restaurant)
              <table class="table table-bordered">
                <tbody>

                  <tr>
                    <th  class="text-center"> restaurant name</th>
                    <th  class="text-center"> image</th>
                    <th  class="text-center"> email</th>
                    <th  class="text-center"> phone</th>
                    <th  class="text-center"> city</th>
                    <th  class="text-center"> district</th>
                    <th  class="text-center"> minimum charge</th>
                    <th  class="text-center">Delivery  </th>
                    <th  class="text-center"> Status </th>

                  </tr>
                  
                        <tr>
                            <td  class="text-center"> {{ $restaurant->name}}  </td>
                            <td  class="text-center"> {{ $restaurant->image}} </td>
                            <td  class="text-center"> {{ $restaurant->email}} </td>     
                            <td  class="text-center"> {{ $restaurant->phone}} </td>
                            <td  class="text-center"> {{ $restaurant->district->city->name}} </td>
                            <td  class="text-center"> {{ $restaurant->district->name}} </td>
                            <td  class="text-center"> {{$restaurant->minimum_charge}}  </td>
                            <td  class="text-center"> {{$restaurant->delivery}}  </td>
                            {{-- <td  class="text-center"> {{ $restaurant->activated ?"Active":"Deactivated"}} </td> --}}
                            <td class="text-center">
                              @if($restaurant->activated)
                           <a href="{{url(route('restaurant.deActive',$restaurant->id))}}" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> إيقاف</a>
                              @else
                                  <a href="{{url(route('restaurant.active',$restaurant->id))}}" class="btn btn-xs btn-success"><i class="fa fa-check"></i> تفعيل</a>
                              @endif
                           </td>
                        </tr>
                 
                </tbody>
              </table>    

            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">nodata</h4>
                </div>
            @endif
                <br>
<div class="box-body">
  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
    <div class="row">
      <div class="col-sm-6">

      </div>
  <div class="col-sm-6">

  </div>
</div>
  <div class="row">
    <div class="col-sm-12">
      <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
        <thead>
        <tr role="row">
          <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Product</th>
          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Image</th>
          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">description</th>
          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">price</th>
          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">prep time</th>
          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">discount_price</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($products as $product)
          <tr role="row" class="odd">
            <td class="sorting_1">{{ $product->name}}</td>
            <td>{{ $product->image}}</td>
            <td>{{ $product->description}}</td>
            <td>{{ $product->price}}</td>
            <td>{{ $product->prep_time}}</td>
            <td>{{ $product->discount_price}}</td>
          </tr>   
          @endforeach
          
        </tbody>
      
       </table>
     </div>
    </div>
    
  </div>
  {{$products->links()}}
</div>

        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  