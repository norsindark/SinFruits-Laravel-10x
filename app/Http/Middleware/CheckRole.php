<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        // Kiểm tra xem người dùng có vai trò mong muốn không
        if ($request->user() && $request->user()->role == $role) {
            return $next($request);
        }

        // Người dùng không có vai trò mong muốn, chuyển hướng hoặc hiển thị lỗi tùy thuộc vào yêu cầu của bạn
        abort(404, 'ERROR.');
    }
}