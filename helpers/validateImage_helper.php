<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('isValidBase64Image')) {
	function isValidBase64Image($base64)
	{
		// remove data:image/...;base64, prefix if exists
		if (strpos($base64, 'base64,') !== false) {
			$base64 = explode('base64,', $base64)[1];
		}

		// check base64 format
		if (!base64_decode($base64, true)) {
			return false;
		}

		$image = base64_decode($base64);

		// check if valid image
		if (@imagecreatefromstring($image) === false) {
			return false;
		}

		return true;
	}
}

function safeBase64Image($base64)
{
    if (empty($base64)) {
        return false;
    }

    // detect base64 prefix
    if (preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
        $base64 = substr($base64, strpos($base64, ',') + 1);
        $type = strtolower($type[1]);
    } else {
        return false;
    }

    // decode base64
    $data = base64_decode($base64, true);

    if ($data === false) {
        return false;
    }

    // verify image
    $img = @imagecreatefromstring($data);
    if ($img === false) {
        return false;
    }

    imagedestroy($img);

    return true;
}