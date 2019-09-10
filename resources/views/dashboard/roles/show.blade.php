@extends('layouts.app')


@section('page_title', $post->title .' post details')
                 
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
            @if ($post)
              <table class="table table-bordered">
                <tbody>

                  <tr>
                    <th  class="text-center"> post title</th>
                    <th  class="text-center"> content</th>
                    <th  class="text-center"> Category</th>

                    <th  class="text-center"> created at </th>

                    <th  class="text-center"> image </th>
                    <th  class="text-center"> edit </th>
                    <th  class="text-center"> Delete </th>
                   

                  </tr>
                  
                      <tr>
                         <td  class="text-center"> {{ $post->title}}  </td>
                         <td  class="text-center"> {{ $post->content}} </td>  
                         <td  class="text-center"> {{ $post->Category->name}} </td>
   
                         <td  class="text-center"> {{ $post->created_at}} </td>
                        @if ($post->image)
                      <td  class="text-center"> <img src="{{asset('storage/'.$post->image) }}" alt="image" width="200" height="200"> </td>

                        @endif
                         <td  class="text-center"> 
                            <a href="{{ url(route('post.edit',$post->id)) }}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> </a>
                          </td>
                         <td  class="text-center">
                            <form action="{{action('PostController@destroy',$post->id)}}" method="post">
                              @method('DELETE')
                              @csrf
                              <button type="submit" class="btn btn-sm btn-danger"><i class=" fa fa-trash-o"></i></button>
                            </form>
                          </td>

                        </tr>
                 
                </tbody>
              </table>    

            @else
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">nodata</h4>
                </div>
            @endif
        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  