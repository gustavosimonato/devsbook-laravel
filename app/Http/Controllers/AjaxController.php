<?php

namespace App\Http\Controllers;

use App\PostComment;
use App\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($id)
    {
        $loggedUser = Auth::user();

        $myLike = PostLike::where('id_post', $id)
            ->where('id_user', $loggedUser->id)
            ->get();

        if (count($myLike) > 0) {
            $del_like = PostLike::where('id_post', $id)
                ->where('id_user', $loggedUser->id)->get();
            $del_like->delete();
        } else {
            $add_like = new PostLike;
            $add_like->id_post = $id;
            $add_like->id_user = $loggedUser->id;
            $add_like->save();
        }
    }

    public function comment(Request $request)
    {
        $loggedUser = Auth::user();

        $id = $request->input('id');
        $txt = $request->input('txt');

        $add_comment = new PostComment;
        $add_comment->id_post = $id;
        $add_comment->id_user = $loggedUser->id;
        $add_comment->body = $txt;
        $add_comment->save();

        $array['link'] = '/perfil/' . $loggedUser->id;
        $array['avatar'] = '/media/avatars/' . $loggedUser->avatar;
        $array['name'] = $loggedUser->name;
        $array['body'] = $txt;

        header("Content-Type: application/json");
        echo json_encode($array);
        exit;
    }

    public function upload()
    {
        /* $array = ['error' => ''];

        if (isset($_FILES['photo']) && !empty($_FILES['photo']['tmp_name'])) {
            $photo = $_FILES['photo'];

            $maxWidth = 800;
            $maxHeight = 800;

            if (in_array($photo['type'], ['image/png', 'image/jpg', 'image/jpeg'])) {

                list($widthOrig, $heightOrig) = getimagesize($photo['tmp_name']);
                $ratio = $widthOrig / $heightOrig;

                $newWidth = $maxWidth;
                $newHeight = $maxHeight;
                $ratioMax = $maxWidth / $maxHeight;

                if ($ratioMax > $ratio) {
                    $newWidth = $newHeight * $ratio;
                } else {
                    $newHeight = $newWidth / $ratio;
                }

                $finalImage = imagecreatetruecolor($newWidth, $newHeight);
                switch ($photo['type']) {
                    case 'image/png':
                        $image = imagecreatefrompng($photo['tmp_name']);
                        break;
                    case 'image/jpg':
                    case 'image/jpeg':
                        $image = imagecreatefromjpeg($photo['tmp_name']);
                        break;
                }

                imagecopyresampled(
                    $finalImage,
                    $image,
                    0,
                    0,
                    0,
                    0,
                    $newWidth,
                    $newHeight,
                    $widthOrig,
                    $heightOrig
                );

                $photoName = md5(time() . rand(0, 9999)) . '.jpg';
                imagejpeg($finalImage, 'media/uploads/' . $photoName);

                PostHandler::addPost(
                    $this->loggedUser->id,
                    'photo',
                    $photoName
                );
            }
        } else {
            $array['error'] = 'Nenhuma imagem enviada';
        }

        header("Content-Type: application/json");
        echo json_encode($array);
        exit; */
    }
}
