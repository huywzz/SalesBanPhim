<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\HomepageImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageImagesController extends Controller
{
    //
    public function index()
    {
        $homepageSliders = HomepageImages::where([
            ['type', '=', 'homepage_slider_img'],
        ])->get();

        $homepageBanners = HomepageImages::where([
            ['type', '=', 'homepage_banner_img'],
        ])->get();

        $homepageInstagrams = HomepageImages::where([
            ['type', '=', 'homepage_instagram_img'],
        ])->get();

        $title = 'Homepage Image';

        return view('admin.homepage.image.index', compact('homepageSliders', 'homepageBanners', 'homepageInstagrams', 'title'));
    }

    public function store(Request $request)
    {

        $path = '';

        if ($request->type == "homepage_slider_img") {
            foreach ($request->file('homepage_slider_img') as $file) {
                $path = Storage::disk('public')->put('/homepage_slider', $file);
                HomepageImages::insert([
                    'file_name' => $path,
                    'type' => $request->type
                ]);
            }
        }
        if ($request->type == "homepage_banner_img") {
            foreach ($request->file('homepage_banner_img') as $file) {
                $path = Storage::disk('public')->put('/homepage_banner', $file);
                HomepageImages::insert([
                    'file_name' => $path,
                    'type' => $request->type
                ]);
                
            }
        }
        if ($request->type == "homepage_instagram_img") {
            foreach ($request->file('homepage_instagram_img') as $file) {
                $path = Storage::disk('public')->put('/homepage_instagram', $file);
                HomepageImages::insert([
                    'file_name' => $path,
                    'type' => $request->type
                ]);
            }
        }

        // ProductImages::insert([
        //     'product_id' => $request->product_id,
        //     'file_name' => $path,
        //     'type' => $request->type
        // ]);

        return back();
    }

    public function destroy($idImage)
    {
        $homepageImage = HomepageImages::find($idImage);

        $file_name = $homepageImage->file_name;

        if (!$file_name)
            unlink($file_name);
        $homepageImage->delete();

        return back();
    }
}
