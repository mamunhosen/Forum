<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Like;

class LikeController extends Controller
{
    public function index()
    {
        try {

            $decrypted_id = decrypt(Request::get('post_id'));
            $is_liked=Like::IP(Request::ip())->PostId($decrypted_id)->first();
            $message='failed';
            if (!$is_liked) {
                Like::create(['ip'=>Request::ip(),'post_id'=>$decrypted_id]);
                $message='success';
            }
        $total_likes=Like::PostId($decrypted_id)->get()->count();
        return response()->json([
            'message' => $message,
            'like'    => $total_likes
        ]);

        } catch (DecryptException $e) {
            return response()->json([
            'message' => 'invalid id'
        ],404);
        }

    }
}
