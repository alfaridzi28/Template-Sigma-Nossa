<?php

namespace App\Helper;

class FS {
	static function delete($file){
		if(\File::exists($file)) \File::delete($file);
	}

	static function replace($path, $name, $image){
		FS::delete($path . '/' . $name);
		return FS::save($path, $image);
	}

	static function save($path, $image){
		$newPath = str_replace('\\', '/', $image->move($path, \Str::random(4) . '_' . $image->getClientOriginalName()));

		return str_replace($path . '/' , '', $newPath);
	}
}
