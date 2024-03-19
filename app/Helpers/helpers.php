<?php



if (!function_exists('getProfileImage')) {
    function getProfileImage($size = 64)
    {
        if (auth()->check()) {
            if (auth()->user()->profile_url) {
                return asset('storage/' . auth()->user()->profile_url);
            } else {
                $authName = auth()->user()->name;
                return "https://api.dicebear.com/8.x/initials/svg?seed={$authName}&radius=50&size={$size}&backgroundColor=1e88e5";
            }
        }
    }
}
function test()
{
    echo "hi";
}
