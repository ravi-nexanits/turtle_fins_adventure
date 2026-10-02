@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <form action="{{ route('admin.albums.update', $album->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">

                            {{-- Album Name --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Gallery Name')</label>
                                    <input type="text" name="name" class="form-control"
                                           value="{{ old('name', $album->name) }}" required>
                                </div>
                            </div>

                            {{-- Thumbnail --}}
                            <div class="col-md-12">
                                <div class="card border--dark mb-4">
                                    <div class="card-header bg--dark">
                                        <h5 class="text-white mb-0">@lang('Thumbnail')</h5>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-2 imageItem">
                                                <div class="payment-method-item">
                                                    <div class="payment-method-header d-flex flex-wrap">
                                                        <div class="thumb" style="position: relative;">
                                                            <div class="avatar-preview">
                                                                <div class="profilePicPreview"
                                                                     style="background-image: url('{{ getImage(imagePath()["album_thumbnail"]["path"] . "/" . $album->thumbnail) }}')">
                                                                </div>
                                                            </div>

                                                            <div class="avatar-edit">
                                                                <input type="file"
                                                                       name="thumbnail"
                                                                       class="profilePicUpload"
                                                                       id="thumbnail"
                                                                       accept=".png, .jpg, .jpeg">
                                                                <label for="thumbnail" class="bg-primary">
                                                                    <i class="la la-pencil"></i>
                                                                </label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div> {{-- row --}}
                                    </div>
                                </div>
                            </div>

                            {{-- Multiple Images --}}
                            <div class="col-md-12">
                                <div class="card border--dark mb-4">
                                    <div class="card-header bg--dark d-flex justify-content-between">
                                        <h5 class="text-white">@lang('Gallery Images')</h5>
                                        <button type="button" class="btn btn-sm btn-outline-light addBtn">
                                            <i class="fa fa-fw fa-plus"></i>@lang('Add New')
                                        </button>
                                    </div>

                                    <div class="card-body">
                                        <p><small class="text-facebook">@lang('Images will be resized automatically')</small></p>

                                        <div class="row element">

                                            {{-- Existing Images --}}
                                            @foreach($album->images as $img)
                                                <div class="col-md-2 imageItem existingItem">
                                                    <div class="payment-method-item">
                                                        <div class="payment-method-header d-flex flex-wrap">
                                                            <div class="thumb" style="position: relative;">

                                                                <div class="avatar-preview">
                                                                    <div class="profilePicPreview"
                                                                         style="background-image: url('{{ getImage(imagePath()["album_images"]["path"] . "/" . $img->image_path) }}')">
                                                                    </div>
                                                                </div>

                                                                <div class="avatar-remove">
                                                                    <label class="bg-danger removeExistingBtn"
                                                                           data-id="{{ $img->id }}">
                                                                        <i class="la la-close"></i>
                                                                    </label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            
                                        </div> {{-- row element --}}
                                    </div>
                                </div>
                            </div>

                        </div> {{-- row --}}
                    </div> {{-- card-body --}}

                    <div class="card-footer">
                        <button class="btn btn--primary w-100">@lang('Update Gallery')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection


@push('breadcrumb-plugins')
    <a href="{{ route('admin.albums.index') }}"
       class="btn btn-sm btn--primary box--shadow1 text-white text--small">
        <i class="fa fa-fw fa-backward"></i>@lang('Go Back')
    </a>
@endpush



@push('style')
<style>
    .avatar-remove {
        position: absolute;
        bottom: 180px;
        right: 0;
        cursor: pointer;
    }
    .avatar-remove label {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        text-align: center;
        line-height: 30px;
        font-size: 15px;
    }
</style>
@endpush



@push('script')
<script>
(function ($) {
    "use strict";

    let counter = 0;

    // Add Image Button
    $('.addBtn').click(function () {
        counter++;

        $('.element').append(`
            <div class="col-md-2 imageItem">
                <div class="payment-method-item">
                    <div class="payment-method-header d-flex flex-wrap">
                        <div class="thumb" style="position: relative;">
                            <div class="avatar-preview">
                                <div class="profilePicPreview"
                                     style="background-image: url('{{ asset('assets/images/default.png') }}')">
                                </div>
                            </div>
                            <div class="avatar-edit">
                                <input type="file" name="images[]"
                                       class="profilePicUpload" id="image${counter}"
                                       accept=".png, .jpg, .jpeg" required>
                                <label for="image${counter}" class="bg-primary">
                                    <i class="la la-pencil"></i>
                                </label>
                            </div>

                            <div class="avatar-remove">
                                <label class="bg-danger removeBtn">
                                    <i class="la la-close"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);

        bindRemove();
        bindUploadPreview();
    });

    // Remove New Image Element
    function bindRemove() {
        $('.removeBtn').off().on('click', function () {
            $(this).closest('.imageItem').remove();
        });
    }

    // Remove Existing Image (AJAX)
    $('.removeExistingBtn').click(function () {
        let id = $(this).data('id');
        let item = $(this).closest('.existingItem');

        $(item).remove();
        $('<input>').attr({
            type: 'hidden',
            name: 'delete_images[]',
            value: id
        }).appendTo('form');
    });

    // Preview Uploaded Image
    function bindUploadPreview() {
        $(".profilePicUpload").off().on('change', function () {
            let input = this;

            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    let preview = $(input).closest('.thumb').find('.profilePicPreview');
                    preview.css('background-image', 'url(' + e.target.result + ')').hide().fadeIn(65);
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    }

    bindRemove();
    bindUploadPreview();

})(jQuery);
</script>
@endpush
