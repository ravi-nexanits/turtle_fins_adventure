@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate.'partials.breadcrumb')

@php
    $contact_content = getContent('contact.content', true);
@endphp

<!-- contact section start -->
<section class="pt-50 pb-50">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-7">
          <div class="contact-thumb">
            <img src="{{ getImage('assets/images/frontend/contact/' . @$contact_content->data_values->image, '641x757') }}" alt="image">
          </div>
        </div>
        <div class="col-lg-5 ps-lg-5">
          <h2 class="section-title">{{ __(@$contact_content->data_values->title) }}</h2>
          <p class="mt-3">{{ __(@$contact_content->data_values->content) }}</p>
          <form class="contact-form mt-5" action="" method="POST">
              @csrf

            <div class="form-group">
              <label>@lang('Name')</label>
              <input name="name" type="text" placeholder="@lang('Your Name')" class="form--control" value="{{ auth()->check() ? auth()->user()->fullname : old('name') }}" @if(auth()->user()) readonly @endif required>
            </div>
            <div class="form-group">
              <label>@lang('Email')</label>
              <input name="email" type="text" placeholder="@lang('Enter E-Mail Address')" class="form--control" value="{{ auth()->check() ? auth()->user()->email : old('email') }}" @if(auth()->user()) readonly @endif required>
            </div>
            <div class="form-group">
              <label>@lang('Subject')</label>
              <input name="subject" type="text" placeholder="@lang('Write your subject')" class="form--control" value="{{old('subject')}}" required>
            </div>
            <div class="form-group">
              <label>@lang('Messages')</label>
              <textarea name="message" wrap="off" placeholder="@lang('Write your message')" class="form--control">{{old('message')}}</textarea>
            </div>
            <button type="submit" class="btn btn--base">@lang('Submit Now')</button>
          </form>
        </div>
      </div><!-- row end -->
      <div class="row g-4 mt-4 justify-content-center">
        <div class="col-sm-10 col-md-6 col-xl-4">
          <div class="contact-item">
            <div class="icon">
              <i class="las la-map-marked-alt"></i>
            </div>
            <div class="cont">
              <h6 class="mb-2">@lang('Head Office: Mumbai')</h6>
              <p>S/32, Sonam Shopping Center, Near Balaji Hospital, Phase 6, Mira bhayander Road, Mira Road East, Thane - 401105, Maharashtra, India.</p>
            </div>
          </div><!-- contact-item end -->
        </div>
        <div class="col-sm-10 col-md-6 col-xl-4">
          <div class="contact-item">
            <div class="icon">
            <i class="las la-phone"></i>
          </div>
            <div class="cont">
              <h6 class="mb-2">@lang('Phone')</h6>
              <p>+918900928786 / +919474293476</p>
            </div>
          </div><!-- contact-item end -->
        </div>
        <div class="col-sm-10 col-md-6 col-xl-4">
          <div class="contact-item">
            <div class="icon">
            <i class="las la-envelope"></i>
          </div>
            <div class="cont">
              <h6 class="mb-2">@lang('Email Address')</h6>
              <p>@php echo @$contact_content->data_values->email @endphp</p>
            </div>
          </div><!-- contact-item end -->
        </div>
      </div>
    </div>
  </section>
  <!-- contact section end -->
  
<!-- contact section start -->
<section class="pt-50 pb-50">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-7">
          <div class="contact-thumb">
          </div>
        </div>
        <div class="col-lg-5 ps-lg-5">
          <!--<form class="contact-form mt-5" action="" method="POST">-->
              
<!--
            <div class="form-group">
              <label>@lang('Name')</label>
              <input name="name" type="text" placeholder="@lang('Your Name')" class="form--control" value="{{ auth()->check() ? auth()->user()->fullname : old('name') }}" @if(auth()->user()) readonly @endif required>
            </div>
            <div class="form-group">
              <label>@lang('Email')</label>
              <input name="email" type="text" placeholder="@lang('Enter E-Mail Address')" class="form--control" value="{{ auth()->check() ? auth()->user()->email : old('email') }}" @if(auth()->user()) readonly @endif required>
            </div>
            <div class="form-group">
              <label>@lang('Subject')</label>
              <input name="subject" type="text" placeholder="@lang('Write your subject')" class="form--control" value="{{old('subject')}}" required>
            </div>
            <div class="form-group">
              <label>@lang('Messages')</label>
              <textarea name="message" wrap="off" placeholder="@lang('Write your message')" class="form--control">{{old('message')}}</textarea>
            </div>
            <button type="submit" class="btn btn--base">@lang('Submit Now')</button>
          </form>-->
        </div>
      </div><!-- row end -->
      <div class="row g-4 mt-4 justify-content-center">
        <div class="col-sm-10 col-md-6 col-xl-4">
          <div class="contact-item">
            <div class="icon">
              <i class="las la-map-marked-alt"></i>
            </div>
            <div class="cont">
              <h6 class="mb-2">Branch Office : Port Blair</h6>
              <p>2nd floor, Vinayak Colony, Pothrapur , Port Blair - 744103 , Andaman & Nicobar Island</p>
            </div>
          </div><!-- contact-item end -->
        </div>
        <div class="col-sm-10 col-md-6 col-xl-4">
          <div class="contact-item">
            <div class="icon">
            <i class="las la-map-marked-alt"></i>
          </div>
            <div class="cont">
              <h6 class="mb-2">Branch Office : Nagpur</h6>
              <p>B-44, Shavitry Niwas, S.D, Hospital Road, Azam Shah Layout, Ganesh Nagar, Nagpur - 440024</p>
            </div>
          </div><!-- contact-item end -->
        </div>
        <!--<div class="col-sm-10 col-md-6 col-xl-4">-->
        <!--  <div class="contact-item">-->
        <!--    <div class="icon">-->
        <!--    <i class="las la-map-marked-alt"></i>-->
        <!--  </div>-->
        <!--    <div class="cont">-->
        <!--      <h6 class="mb-2">Branch Office : Ahmedabad</h6>-->
        <!--      <p>Shop no. 117, 1st Floor, Vitthal Plaza, Near GEB office, Nava Naroda, Ahmedabad - 382330</p>-->
        <!--    </div>-->
        <!--  </div><!-- contact-item end -->
        <!--</div>-->
      </div>
</section>
  <!-- contact section end -->  
  

  <!-- map area start -->
  <div class="map-area">
   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d232.586817467303!2d79.11594744340104!3d21.136908943641348!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd4c7ca31ca1421%3A0x276650fabb5e916!2sTURTLEFINS%20ADVENTURE%20TRAVEL%20STUDIO!5e0!3m2!1sen!2sin!4v1655825406805!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
  <!-- map area end -->
@endsection
