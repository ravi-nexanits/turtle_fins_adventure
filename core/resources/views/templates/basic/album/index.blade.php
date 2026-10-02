@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate.'partials.breadcrumb')

    <div class="pt-50 pb-50">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <div class="row gy-4">
                        @forelse($albums as $album)
                            <div class="col-xl-4 col-sm-6">
                                <div class="trip-card h-100">
                                    <div class="trip-card__thumb">
                                        <a href="{{ route('album.details', [$album->id]) }}" class="w-100 h-100">
                                            <img src="{{ getImage(imagePath()['album_thumbnail']['path'].'/'. $album->thumbnail, imagePath()['album_thumbnail']['size']) }}" alt="image">
                                        </a>
                                    </div>
                                    <div class="trip-card__content">
                                        <h5 class="trip-card__title"><a href="{{ route('album.details', [$album->id]) }}">@lang($album->name)</a></h5>
                                    </div>
                                </div><!-- trip-card end -->
                            </div>
                        @empty
                        <div class="col-12 text-center">
                            <h3>@lang('No Data Found')</h3>
                        </div>
                        @endforelse

                    </div><!-- row end -->

                    <div class="text-end mt-5 pagination-md">
                        {{ $albums->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
