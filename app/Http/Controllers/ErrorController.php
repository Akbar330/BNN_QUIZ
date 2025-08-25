<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ErrorController extends Controller
{
    /**
     * Handle 404 not found errors
     */
    public function notFound(Request $request)
    {
        // Log untuk debugging dan monitoring
        Log::info('404 Error', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'referer' => $request->header('referer')
        ]);

        // Data yang mungkin berguna untuk view
        $data = [
            'requested_url' => $request->fullUrl(),
            'suggestions' => $this->getSuggestions($request->path())
        ];

        // Return ke API jika request mengharapkan JSON
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'Not Found',
                'message' => 'The requested resource was not found.',
                'status' => 404,
                'requested_url' => $request->fullUrl()
            ], 404);
        }

        // Return custom 404 view
        return response()->view('errors.404', $data, 404);
    }

    /**
     * Get URL suggestions based on requested path
     */
    private function getSuggestions($path)
    {
        // Implementasi sederhana untuk saran URL
        $commonRoutes = [
            '/' => 'Beranda',
            '/about' => 'Tentang Kami',
            '/contact' => 'Kontak',
            '/products' => 'Produk',
            '/services' => 'Layanan'
        ];

        // Bisa implementasi fuzzy matching atau algoritma similarity
        return $commonRoutes;
    }
}