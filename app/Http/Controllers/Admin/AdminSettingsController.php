<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class AdminSettingsController extends Controller
{


        public function index(){

            $setting = Setting::first();

            return view('backend.pages.settings.index');
        }
        public function store(Request $request){

        if (Setting::count() > 0) {

        return back()->with('message','Only one entry is allowed in this table');
        }

        else{

        $setting = new Setting;

        $setting->title = $request->title;
        $setting->about_us_headline = $request->about_us_headline;
        $setting->about_us_description = $request->about_us_description;
        $setting->contact_us_description = $request->contact_us_description;
        $setting->phone_no = $request->phone_no;
        $setting->email = $request->email;
        $setting->address = $request->address;
        $setting->terms_conditions = $request->terms_conditions;
        $setting->privacy_policy = $request->privacy_policy;
        $setting->delivery_information = $request->delivery_information;
        $setting->google_map_link = $request->google_map_link;
        $setting->googleplus_address = $request->googleplus_address;
        $setting->facebook_address = $request->facebook_address;
        $setting->instagram_address = $request->instagram_address;
        $setting->twitter_address = $request->twitter_address;
        $setting->pinterest_address = $request->pinterest_address;
        $setting->whatsapp_address = $request->whatsapp_address;

        $logo = $request->file('logo');
        $about_us_image = $request->file('about_us_image');
        

        if($logo){

            $image_name=hexdec(uniqid());
            $ext=strtolower($logo->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/admin/images/logo/';
            $image_url=$upload_path.$image_full_name;
            $success=$logo->move($upload_path,$image_full_name);
            $setting->logo = $image_url;

        }

        if($about_us_image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($about_us_image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/admin/images/about_us_image/';
            $image_url=$upload_path.$image_full_name;
            $success=$about_us_image->move($upload_path,$image_full_name);
            $setting->about_us_image = $image_url;

        }        

        


        $setting->save();


        return back()->with('success','Settings created successfully!');

        }


        }

        public function update(Request $request){


        $setting = Setting::first();

        $setting->title = $request->title;
        $setting->about_us_headline = $request->about_us_headline;
        $setting->about_us_description = $request->about_us_description;
        $setting->contact_us_description = $request->contact_us_description;
        $setting->phone_no = $request->phone_no;
        $setting->email = $request->email;
        $setting->address = $request->address;
        $setting->terms_conditions = $request->terms_conditions;
        $setting->privacy_policy = $request->privacy_policy;
        $setting->delivery_information = $request->delivery_information;
        $setting->google_map_link = $request->google_map_link;
        $setting->googleplus_address = $request->googleplus_address;
        $setting->facebook_address = $request->facebook_address;
        $setting->instagram_address = $request->instagram_address;
        $setting->twitter_address = $request->twitter_address;
        $setting->pinterest_address = $request->pinterest_address;
        $setting->whatsapp_address = $request->whatsapp_address;


        $logo = $request->file('logo');
        $about_us_image = $request->file('about_us_image');
        $old_photo = $request->old_photo;
        $old_about_us_image = $request->old_about_us_image;


        if($logo){

            $image_name=hexdec(uniqid());
            $ext=strtolower($logo->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/admin/images/logo/';
            $image_url=$upload_path.$image_full_name;
            $success=$logo->move($upload_path,$image_full_name);
            $setting->logo = $image_url;

            if($old_photo){

                unlink($old_photo);
            }
        }

        if($about_us_image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($about_us_image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/admin/images/about_us_image/';
            $image_url=$upload_path.$image_full_name;
            $success=$about_us_image->move($upload_path,$image_full_name);
            $setting->about_us_image = $image_url;

            if($old_about_us_image){

                unlink($old_about_us_image);
            }
        }

        


        $setting->save();


        return back()->with('success','Settings updated successfully!');
        }


}
