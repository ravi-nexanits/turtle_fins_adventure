@php
    $testimonial_content = getContent('testimonial.content', true);
    $testimonial_elements = getContent('testimonial.element');
@endphp
<!-- testimonial section start -->
<section class="pt-100 pb-100 bg_img dark--overlay-two" style="background-image: url({{ getImage('assets/images/frontend/testimonial/' . @$testimonial_content->data_values->background_image, '1920x1282') }});">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
                <div class="section-header text-center wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                    <h2 class="section-title text-white">{{ __(@$testimonial_content->data_values->heading) }}</h2>
                    <p class="text-white mt-3">{{ __(@$testimonial_content->data_values->sub_heading) }}</p>
                </div>
            </div>
        </div><!-- row end -->
        <div class="testimonial-slider px-xl-5 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">

            {{--@forelse($testimonial_elements as $item)
                <div class="single-slide">
                    <div class="testimonial-card bg_img" style="background-image: url('{{asset($activeTemplateTrue.'images/bg/small-bg.jpg')}}');">
                        <p>{{ __(@$item->data_values->review) }}</p>
                        <div class="client-details mt-3">
                            <h6 class="name">{{ __(@$item->data_values->name) }}</h6>
                            <div class="ratings d-flex flex-wrap align-items-center mt-1">
                                @for($i=1; $i <= 5; $i++)
                                    @if($i <= $item->data_values->rating)
                                        <i class="las la-star"></i>
                                    @else
                                        <i class="lar la-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div><!-- testimonial-card end -->
                </div><!-- single-slide end -->
            @empty
            @endforelse --}}
            
            
            {{------------- Google review start -----------------------}}
            @php
            
                $reviews = \App\Http\Services\GoogleReviewService::getReviews();
                
            @endphp
            
            @if(isset($reviews['reviews']))
            
                @foreach($reviews['reviews'] as $review)
                <div class="single-slide">
                    <div class="testimonial-card bg_img" style="background-image: url('{{asset($activeTemplateTrue.'images/bg/small-bg.jpg')}}');">
                        @php
                            $fullText = $review['text'];
                            $limit = 200;
                        @endphp
                        
                        <p>
                            <span class="short-text">
                                {{ \Illuminate\Support\Str::limit($fullText, $limit) }}
                            </span>
                        
                            @if(strlen($fullText) > $limit)
                                <span class="full-text d-none">
                                    {{ $fullText }}
                                </span>
                        
                                <a href="javascript:void(0)"
                                   class="read-more"
                                   onclick="toggleReadMore(this)">Read more</a>
                            @endif
                        </p>
                        <div class="client-details mt-3">
                            <h6 class="name">{{ $review['author_name'] }}</h6>
                            <div class="ratings d-flex flex-wrap align-items-center mt-1">
                                @for($i=1; $i <= 5; $i++)
                                    @if($i <= $review['rating'])
                                        <i class="las la-star"></i>
                                    @else
                                        <i class="lar la-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div><!-- testimonial-card end -->
                </div><!-- single-slide end -->
                @endforeach
            
            @endif
            
            {{------------- Google review end -----------------------}}
        </div>
    </div>
</section>
<!-- testimonial section end -->

@push('style')
    <style>
      .slick-track {
        display: flex !important;
    }
    
    .slick-slide {
        height: auto;
    }
    
    .slick-slide > div {
        height: 100%;
    }
}
</style>
@endpush

@push('script')

<script>
    function toggleReadMore(el) {
        const parent = el.parentElement;
        parent.querySelector('.short-text').classList.toggle('d-none');
        parent.querySelector('.full-text').classList.toggle('d-none');
        el.textContent = el.textContent === 'Read more' ? 'Read less' : 'Read more';
    }
</script>

@endpush
