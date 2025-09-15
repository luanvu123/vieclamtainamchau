<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    public function generate()
    {
        $code = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ123456789"), 0, 5);

        // Lưu captcha vào session
        Session::put('captcha_code', $code);

        // Tạo ảnh
        $image = imagecreate(120, 40);
        $bg = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 0);

        // Nhiễu
        for ($i = 0; $i < 50; $i++) {
            $noiseColor = imagecolorallocate($image, rand(150, 255), rand(150, 255), rand(150, 255));
            imagesetpixel($image, rand(0, 120), rand(0, 40), $noiseColor);
        }

        // Vẽ chữ
        imagestring($image, 5, 22, 10, $code, $textColor);

        ob_start();
        imagepng($image);
        $imgData = ob_get_clean();

        imagedestroy($image);

        return response()->json([
            'captcha' => '<img src="data:image/png;base64,' . base64_encode($imgData) . '" alt="captcha">'
        ]);
    }
}
