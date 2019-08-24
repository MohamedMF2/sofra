@extends('layouts.app')

@section('title' ,__('lang.edit city') )

@section('content')
<!-- Main content -->
 <section class="content">
   
    <!-- Default box -->
     <div class="box">
         <div class="box-header with-border">
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

          <!---------------------------- Form  ------------------------------------>
          
          {{-- <form action="{{ action('CityController@update',$city->id) }}" method="post" autocomplete="off">        
            @method('PUT')
              <div class="form-group">
                <label for="my-input">Name</label>
              <input id="my-input" class="form-control" type="text" name="name" value="{{$city->name}}">
                <span class=" text-danger"> {{ $errors->first('name') }}</span>

              </div>
                                   

              <button type="submit" class="btn btn-primary" > Save </button>

            @csrf
          </form> --}}
          {!! Form::open()!!}

          {!! Form::close() !!}
        

          {!! Form::open(['url'=>route('city.update',['id'=>$city->id]),'method'=>'put' ]) !!}
          {!! Form::label('my-input', __('lang.Name'), array('class' => 'boldfont')) !!}
  
          {!!Form::text('name',$city->name,[
              'class'=>'form-control',
              'id'=>'my-input'
              ]) !!}
              <br>
          {{ Form::button("Save", ['type' => 'submit','class' => 'btn btn-primary btn-md'] )  }}
          {!! Form::close() !!}

          <!----------------------------  End Of Form  ------------------------------------>

         </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

 </section>
<!-- /.content -->

@endsection
    
