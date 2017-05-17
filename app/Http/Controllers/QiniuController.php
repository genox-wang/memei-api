<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Qiniu\Storage\BucketManager;

class QiniuController extends Controller
{
  private $bucket = 'memei';

  private function qiniuAuth(){
    // 用于签名的公钥和私钥
    $accessKey = 'lHdmHGhe7ZAe1VlnLA1bVs_DgJABHk-dCGfvkpB0';
    $secretKey = 'S48LUZo5tz9D9qt_gmyG1nnF4G85EuYlauqGzsGY';
    // 初始化签权对象
    $auth = new Auth($accessKey, $secretKey);
    return $auth;
  }

  public function token() {
    // 生成上传Token
    $token = $this->qiniuAuth()->uploadToken($this->bucket);
    $response = new \stdClass();
    $response->token = $token;
    $response->key = uniqid();
    return json_encode($response);
  }

  public function delete($key) {
     //初始化BucketManager
    $bucketMgr = new BucketManager($this->qiniuAuth());
    //删除$bucket 中的文件 $key
    $err = $bucketMgr->delete($this->bucket, $key);
    if ($err !== null) {
        return 'fail';
    } else {
        return "Success!";
    }
  }
}
