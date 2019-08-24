@extends('layouts.app')
@section('page_title',__('lang.edit setting'))
                  
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
          @if ($settings)
           <form action=""></form>
          <form action="{{ action('SettingController@store')}}" method="post" autocomplete="off">        
              @foreach ($settings as $setting)
            <div class="form-group">
                <label for="my-input">@lang('lang.phone')</label>
            <input id="my-input" class="form-control" type="text" name="phone" value="{{$setting->phone}}">
                <span class=" text-danger"> {{ $errors->first('phone') }}</span>
            </div>

            <div class="form-group">
                <label for="my-input">@lang('lang.email')</label>
                <input id="my-input" class="form-control" type="text" name="email" value="{{$setting->email}}">
                <span class=" text-danger"> {{ $errors->first('email') }}</span>
            </div>

            <div class="form-group">
                <label for="my-input">@lang('lang.facebook')</label>
                <input id="my-input" class="form-control" type="text" name="facebook" value="{{$setting->facebook}}">
                <span class=" text-danger"> {{ $errors->first('facebook') }}</span>
            </div>

            <div class="form-group">
                <label for="my-input">@lang('lang.twitter')</label>
                <input id="my-input" class="form-control" type="text" name="twitter" value="{{$setting->twitter}}">
                <span class=" text-danger"> {{ $errors->first('twitter') }}</span>
            </div>

            <div class="form-group">
                <label for="my-input">@lang('lang.whatsapp')</label>
                <input id="my-input" class="form-control" type="text" name="whatsapp" value="{{$setting->whatsapp}}">
                <span class=" text-danger"> {{ $errors->first('whatsapp') }}</span>
            </div>

            <div class="form-group">
                <label for="my-input">@lang('lang.instagram')</label>
                <input id="my-input" class="form-control" type="text" name="instagram" value="{{$setting->instagram}}">
                <span class=" text-danger"> {{ $errors->first('instagram') }}</span>
            </div>

            <div class="form-group">
                <label for="my-input">@lang('lang.linkedin')</label>
                <input id="my-input" class="form-control" type="text" name="linkedin" value="{{$setting->linkedin}}">
                <span class=" text-danger"> {{ $errors->first('linkedin') }}</span>
            </div>

            <div class="form-group">
                <label for="my-input">@lang('lang.youtube')</label>
                <input id="my-input" class="form-control" type="text" name="youtube" value="{{$setting->youtube}}">
                <span class=" text-danger"> {{ $errors->first('youtube') }}</span>
            </div>

            <div class="form-group">
                <label for="my-input">@lang('lang.google')</label>
                <input id="my-input" class="form-control" type="text" name="google" value="{{$setting->google}}">
                <span class=" text-danger"> {{ $errors->first('google') }}</span>
            </div>

            <div class="form-group">
                <label for="my-text">@lang('lang.about app')</label>
                <textarea id="my-text" class="form-control" name="about"   cols="30" rows="10" >
                 {{$setting->about}}
                </textarea>
                <span class=" text-danger"> {{ $errors->first('about') }}</span>
            </div>
            @endforeach

              <button type="submit" class="btn btn-primary" >@lang('lang.save')  </button>

            @csrf
          </form>
          <!----------------------------  End Of Form  ------------------------------------>

          @endif

        </div>
        <!-- /.box-body -->
        
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
  