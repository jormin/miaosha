<?php


namespace App\Traits;


use Symfony\Component\HttpKernel\Exception\HttpException;

trait ResponseTrait
{

    /**
     * 操作成功
     * @param string $message
     * @param array $data
     * @return array
     */
    public function success($message = '操作成功', $data = array())
    {
        return ['code' => 0, 'message' => $message, 'data' => $data];
    }

    /**
     * 操作失败
     * @param int $code
     * @param string $message
     * @return array
     */
    public function failed($code = -1, $message = '')
    {
        $message = $message ?? empty(config('code.' . $code)) ? '未知的错误' : config('code.' . $code);
        return ['code' => $code, 'message' => $message, 'data' => []];
    }

}