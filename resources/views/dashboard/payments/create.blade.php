@extends('layouts.app')

@section('page_title',__('lang.payments'))
                 
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
<!-- ------------------------------------------------  Form   ------------------------------------------------------------ -->

<form action=""></form>

    <form action="{{action('PaymentController@store')}}" method="post">
          <div class="form-group">
            <label for="restaurants"> @lang('lang.restaurant')</label>
            <select class="form-control form-control-lg" id="restaurants" name="restaurant_id" placeholder=" select ">
                <option disabled selected value> @lang('lang.choose a restaurant for your payment') </option>


              @foreach ($restaurants as $restaurant)
                <option value="{{$restaurant->id}}">{{$restaurant->name }}</option>
              @endforeach
            </select>
            <span class=" text-danger"> {{ $errors->first('restaurant_id') }}</span>

          </div>

          <div class="form-group">
            <label for="payment"> @lang('lang.add payment')</label>
            <input type="text" name="paid" id="payment" class="form-control ">
            <span class=" text-danger"> {{ $errors->first('paid') }}</span>

          </div>

          <div class="form-group">
              <label for="notes">@lang('lang.notes')</label>
              <textarea class="form-control" rows="5" id="notes" name="notes"></textarea>
            </div>
        <button type="submit" class="btn btn-lg btn-success">@lang('lang.add')</button>
          @csrf
        </form> 
     
<!-------------------------------------------------- end of  Form   -------------------------------------------------------------->
      
      </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  