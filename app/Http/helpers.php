<?php


function settings(){
    return \App\Models\Setting::first();
}

function setActive($path, $request, $active = 'active')
{
    return $request->is($path) ? $active : '';
}