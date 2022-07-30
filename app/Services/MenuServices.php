<?php

namespace App\Services;

use App\Models\Menu;

class MenuServices
{
    public function handle($request)
    {
        $request->merge([
            'price' => str_replace('.', '', str_replace('Rp. ', '', $request->price)),
            'menu_file_name' => $this->uploadFile($request),
            
        ]);
        return Menu::UpdateOrCreate(["id" => $request->id],$request->except(['file','filepond']));
    }

    public function uploadFile($request)
    {
        $menu_file = $request->file('file');
        if ($menu_file) {
            $menu_file->move(public_path('file_upload/menu'),$menu_file->getClientOriginalName());
            return $menu_file->getClientOriginalName();
        }else{
            return "default-food.png";
        }
    }
}