<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    use HandlesDirectImageUploads;
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|max:2048',
            'site_favicon' => 'nullable|image|max:1024',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'chatbot_ai_enabled' => 'nullable|string',
            'gemini_api_key' => 'nullable|string|max:255',
            'chatbot_notification_email' => 'nullable|email',
            'brevo_api_key' => 'nullable|string|max:255',
            'mail_from_address' => 'nullable|email',
            'privacy_policy' => 'nullable|string',
        ]);

        $inputs = $request->except('_token');

        foreach ($inputs as $key => $value) {
            if ($request->hasFile($key)) {
                $oldSetting = Setting::where('key', $key)->first();
                if ($oldSetting && $oldSetting->value) {
                    $this->deleteImageDirect($oldSetting->value);
                }
                $value = $this->uploadImageDirect($request->file($key), 'settings');
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
