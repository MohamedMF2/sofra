@extends('layouts.app')

@section('page_title', __('lang.clients'))
                 
@section('content')     
  <!-- Main content -->
  <section class="content">
   
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
          @include('flash::message')


            <h3 class="box-title">  </h3>
            <form action="{{ action('ClientController@index')}}" method="get" autocomplete="off">
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
            @if (count($clients))
              <table class="table table-hover">
                <tbody>

                  <tr class=" text-danger">
                    <th style="width: 10px">#</th>
                    <th class="text-center">@lang('lang.client')</th>
                    <th class="text-center">@lang('lang.phone')</th>
                    <th class="text-center">@lang('lang.email')</th>
                    <th class="text-center">@lang('lang.city')</th>
                    <th class="text-center">@lang('lang.district')</th>
                    <th class="text-center">@lang('lang.change state')</th>
                    <th class="text-center">@lang('lang.delete')</th>


                  </tr>
                  @foreach ($clients as $client)
                      <tr>
                         <td> {{ $loop->iteration}} </td>
                         <td  class="text-center">  {{ $client->name }} </td>
                         <td  class="text-center">  {{ $client->phone }} </td>
                         <td  class="text-center">  {{ $client->email }} </td>
                         <td  class="text-center">  {{ $client->district->city->name}}</td>
                         <td  class="text-center">  {{ $client->district->name}}</td>
                         <td class="text-center">
                          @if($client->activated)
                       <a href="{{url(route('client.deActive',$client->id))}}" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> إيقاف</a>
                          @else
                              <a href="{{url(route('client.active',$client->id))}}" class="btn btn-xs btn-success"><i class="fa fa-check"></i> تفعيل</a>
                          @endif
                       </td>
                        
                         <td  class="text-center">
                           

                            
                            {!! Form::open(['url'=>route('client.destroy',['id'=>$client->id]),'method'=>'delete' ]) !!}
                            {!!Form::button('<i class="fa fa-trash-o" ></i>' , ['type' => 'submit','class' => 'btn btn-danger btn-lg'] )!!}
                            {!! Form::close() !!}

                          </td>
                          
                        </tr>
                  @endforeach
                </tbody>
              </table>    
              {{ $clients->links()}}

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
  