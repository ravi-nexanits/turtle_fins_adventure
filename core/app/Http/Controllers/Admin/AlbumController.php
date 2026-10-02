<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\AlbumImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of albums.
     */
    public function index()
    {
        $albums = Album::withCount('images')->latest()->paginate(20);
        $pageTitle = 'Gallery';
        $empty_message = 'No albums has been added.';
        return view('admin.albums.index', compact('albums','empty_message', 'pageTitle'));
    }

    /**
     * Show the form for creating a new album.
     */
    public function create()
    {
        $pageTitle = 'Add Gallery';
        return view('admin.albums.create', compact('pageTitle'));
    }

    /**
     * Store a newly created album.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'thumbnail'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // Upload thumbnail
        $thumbPath = null;
        if ($request->hasFile('thumbnail')) {
                $path = imagePath()['album_thumbnail']['path'];
                $size = imagePath()['album_thumbnail']['size'];
                $thumbPath = uploadImage($request->file('thumbnail'), $path, $size);
        }

        // Create album
        $album = Album::create([
            'name'      => $validated['name'],
            'thumbnail' => $thumbPath,
        ]);

        // Upload and attach images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = imagePath()['album_images']['path'];
                $album->images()->create(['image_path' => uploadImage($image, $path)]);
            }
        }
        
        return redirect()
                ->route('admin.albums.index')
                ->with('success', 'Album created successfully.');
    }

    /**
     * Show single album.
     */
    public function show(Album $album)
    {
        $album->load('images');
        return view('admin.albums.show', compact('album'));
    }

    /**
     * Show edit form.
     */
    public function edit(Album $album)
    {
        $pageTitle = 'Edit Gallery';
        return view('admin.albums.edit', compact('album', 'pageTitle'));
    }

    /**
     * Update the album.
     */
    public function update(Request $request, Album $album)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'thumbnail'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // Replace thumbnail if uploaded
        if ($request->hasFile('thumbnail')) {

            // Delete old file
            $path = imagePath()['album_thumbnail']['path'];
            if ($album->thumbnail && file_exists($path.'/'.$album->thumbnail)) {
                removeFile($path.'/' . $album->thumbnail);
            }

            $size = imagePath()['album_thumbnail']['size'];
            $album->thumbnail = uploadImage($request->file('thumbnail'), $path, $size);
        }

        $album->name = $validated['name'];
        $album->save();

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = imagePath()['album_images']['path'];
                $album->images()->create(['image_path' => uploadImage($image, $path)]);
            }
        }
        
        /* -------------------------------
         | DELETE SELECTED IMAGES
         * ------------------------------- */
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imgId) {
    
                $image = AlbumImage::find($imgId);
    
                if ($image) {
                    // Delete file from storage
                    $path = imagePath()['album_images']['path'] . '/' . $image->image_path;
    
                    if (file_exists($path)) {
                        removeFile($path.'/' . $path);
                    }
    
                    // Delete DB record
                    $image->delete();
                }
            }
        }

        return redirect()
            ->route('admin.albums.index')
            ->with('success', 'Album updated successfully.');
    }

    /**
     * Remove the album and its images.
     */
    public function destroy(Album $album)
    {
        // Delete thumbnail
        $path = imagePath()['album_thumbnail']['path'];
        if ($album->thumbnail && file_exists($path.'/'.$album->thumbnail)) {
            removeFile($path.'/' . $album->thumbnail);
        }

        // Delete all images from storage
        foreach ($album->images as $img) {
            $path = imagePath()['album_images']['path'];
            if ( file_exists($path.'/'.$img->image_path)) {
                removeFile($path.'/'.$img->image_path);
            }
        }

        $album->delete();

        return redirect()
            ->route('admin.albums.index')
            ->with('success', 'Album deleted successfully.');
    }
}
