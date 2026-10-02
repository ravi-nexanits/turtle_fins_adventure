@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate.'partials.breadcrumb')

    <div class="pt-50 pb-50">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <div class="gy-4 grid gallery-page">
                            <div class="grid-sizer"></div>
                            @forelse ($images as $img)
                                <div class="gallery-card grid-item p-1">
                                    <img src="{{ getImage(imagePath()['album_images']['path'].'/'. $img->image_path) }}" class="rounded" />
                                    <a href="{{ getImage(imagePath()['album_images']['path'].'/'.$img->image_path ) }}" data-rel="lightcase:gallery:slideshow" class="view-thumb"><i class="las la-plus"></i></a>
                                </div>
                             @empty
                            <div class="col-12 text-center">
                                <h3>@lang('No Data Found')</h3>
                            </div>
                            @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-lib')
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
@endpush

@push('script')

    <script>
        var elem = document.querySelector('.grid');
    
        var msnry = new Masonry(elem, {
            itemSelector: '.grid-item',
            columnWidth: '.grid-sizer',
            percentPosition: true
        });
    </script>

@endpush('script')
