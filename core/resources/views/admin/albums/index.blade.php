@extends('admin.layouts.app')

@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light tabstyle--two">
                        <thead>
                            <tr>
                                <th scope="col">@lang('Thumbnail')</th>
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Images')</th>
                                <th scope="col">@lang('Created At')</th>
                                <th scope="col">@lang('Actions')</th>
                            </tr>
                        </thead>

                        <tbody>
                        @forelse ($albums as $album)
                            <tr>
                                <td data-label="@lang('Thumbnail')">
                                    @if($album->thumbnail)
                                        <img src="{{ getImage(imagePath()["album_thumbnail"]["path"] . "/" . $album->thumbnail) }}" alt="thumb" width="60" height="60" class="rounded">
                                    @else
                                        <span class="text-muted">@lang('No Image')</span>
                                    @endif
                                </td>

                                <td data-label="@lang('Name')">
                                    <strong>{{ __($album->name) }}</strong>
                                </td>


                                <td data-label="@lang('Images')">
                                    <span class="badge badge--primary">
                                        {{ $album->images_count }}
                                    </span>
                                </td>

                                <td data-label="@lang('Created At')">
                                    {{ showDateTime($album->created_at) }} <br>
                                    <small class="text-muted">{{ diffForHumans($album->created_at) }}</small>
                                </td>

                                <td data-label="@lang('Actions')">

                                    <a href="{{ route('admin.albums.edit', $album->id) }}" 
                                        class="icon-btn ml-1" 
                                        data-toggle="tooltip" 
                                        title="@lang('Edit')">
                                        <i class="la la-edit"></i>
                                    </a>

                                    <a href="javascript:void(0)" 
                                        class="icon-btn btn--danger ml-1 deleteBtn"
                                        data-url="{{ route('admin.albums.destroy', $album->id) }}"
                                        data-toggle="tooltip"
                                        title="@lang('Delete')">
                                        <i class="la la-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-muted text-center" colspan="100%">
                                    {{ __($empty_message) }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table><!-- table end -->
                </div>
            </div>

            <div class="card-footer">
                {{ $albums->links('admin.partials.paginate') }}
            </div>
        </div><!-- card end -->
    </div>
</div>

{{-- Delete MODAL --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">@lang('Delete Album')</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="post" action="">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <p class="text-muted">@lang('Are you sure you want to delete this album? This cannot be undone.')</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('No')</button>
                    <button type="submit" class="btn btn--danger deleteButton">@lang('Yes')</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.albums.create') }}" 
       class="btn btn-sm btn--primary box--shadow1 text-white text--small">
       <i class="fa fa-fw fa-plus"></i>@lang('Add New')
    </a>
@endpush

@push('script')
<script>
(function($){
    "use strict";

    // Delete modal
    $('.deleteBtn').on('click', function () {
        var modal = $('#deleteModal');
        var url = $(this).data('url');

        modal.find('form').attr('action', url);
        modal.modal('show');
    });

})(jQuery);
</script>
@endpush
