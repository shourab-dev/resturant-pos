<?php



if (!function_exists('getProfileImage')) {
    function getProfileImage($size=64)
    {
        return "https://api.dicebear.com/8.x/initials/svg?seed=shourab&radius=50&size=$size&backgroundColor=1e88e5";
    }
}
function test()
{
    echo "hi";
}
