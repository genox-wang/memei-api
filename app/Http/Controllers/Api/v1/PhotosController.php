<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Photo;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Qiniu\Storage\BucketManager;

class PhotosController extends Controller
{
    /**
     * @apiDefine 200Success
     *
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     */

    private $bucket = 'memei';

    private function qiniuAuth(){
      // 用于签名的公钥和私钥
      $accessKey = 'lHdmHGhe7ZAe1VlnLA1bVs_DgJABHk-dCGfvkpB0';
      $secretKey = 'S48LUZo5tz9D9qt_gmyG1nnF4G85EuYlauqGzsGY';
      // 初始化签权对象
      $auth = new Auth($accessKey, $secretKey);
      return $auth;
    }

    /**
     * @api {post} /photos/ Store
     * @apiGroup Photos
     *
     * @apiParam {String} key Key for photo
     * @apiParam {Number} card_id Id for photo's card
     *
     * @apiUse 200Success
     */
    public function store(Request $r)
    {
        $photo = [
            'key' => $r->key,
            'card_id' => $r->card_id,
        ];
        Photo::create($photo);
    }

    /**
     * @api {delete} /photos/:id Delete
     * @apiGroup Photos
     *
     * @apiUse 200Success
     */
    public function delete($id)
    {
        $photo = Photo::findOrFail($id);
        //初始化BucketManager
        $bucketMgr = new BucketManager($this->qiniuAuth());
       //删除$bucket 中的文件 $key
        $err = $bucketMgr->delete($this->bucket, $photo->key);

        $photo->delete();

        if ($err !== null) {
            return 'fail';
        } else {
            return "Success!";
        }
    }

    /**
     * @api {get} /photos/uptoken UpToken
     * @apiGroup Photos
     *
     * @apiParam {String} key Key for photo
     * @apiParam {Number} card_id Id for photo's card
     *
     * @apiSuccess (200) {String} token Token for qiniu upload
     */
    public function uptoken()
    {
        $token = $this->qiniuAuth()->uploadToken($this->bucket);
        $response = new \stdClass();
        $response->token = $token;
        $response->key = uniqid();
        return json_encode($response);
    }
}
