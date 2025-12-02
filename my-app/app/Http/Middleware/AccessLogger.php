<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AccessLogger {
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // リクエストのログを出力
        $arrLog = [
            "REQUEST URI: " => $request->getUri(),
            "REQUEST METHOD: " => $request->getMethod(),
            "REQUEST HEADER: " => $request->headers->all(),
            "REQUEST BODY: " => $request->all()
        ];
        
        Log::info('リクエストスタート:', $arrLog);

        // コントローラー処理へ
        $response = $next($request);

        // レスポンスのログを出力
        $responseLog = [
            "RESPONSE STATUS" => $response->getStatusCode(),
            "RESPONSE HEADER" => $response->headers->all(),
            "RESPONSE BODY"   => $this->convertResponseContent($response)
        ];
        
        Log::info('リクエスト終了:', $responseLog);

        return $response;
    }

    private function convertResponseContent($response)
    {
        $content = $response->getContent();

        // JSONなら配列にして返す（見やすい）
        if ($this->isJson($response)) {
            return json_decode($content, true);
        }

        // HTMLなら先頭200文字だけ（ログ汚染防止）
        if ($this->isHtml($response)) {
            return mb_substr($content, 0, 200) . '...';
        }

        // それ以外はそのまま文字列で
        return $content;
    }

    private function isJson($response)
    {
        return str_contains($response->headers->get('Content-Type'), 'application/json');
    }

    private function isHtml($response)
    {
        return str_contains($response->headers->get('Content-Type'), 'text/html');
    }
}