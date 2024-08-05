<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SitemapController extends Controller
{
    public function generateSitemap()
    {
        // Path ke direktori public
        $publicPath = public_path('json');

        // Ambil semua file JSON dari direktori public
        $files = File::allFiles($publicPath);

        // Format keywords untuk sitemap
        $formattedKeywords = collect($files)->map(function ($file) use ($publicPath) {
            $path = str_replace($publicPath, '', $file->getPathname());
            $path = trim($path, '/'); // Menghapus karakter slash di awal dan akhir

            // Menghapus ekstensi .json dan menambahkan /article/
            $keyword = pathinfo($path, PATHINFO_FILENAME);
            $formattedKeyword = preg_replace('/[^a-zA-Z0-9-]/', '-', $keyword); // Hanya simbol yang diganti
            $formattedKeyword = str_replace(' ', '-', $formattedKeyword); // Ganti spasi dengan -

            return [
                'loc' => url("/article/$formattedKeyword"),
                'lastmod' => date('c', $file->getMTime()), // Tanggal modifikasi terakhir
                'changefreq' => 'daily',
                'priority' => '0.5', // Atur sesuai kebutuhan
            ];
        });

        // Render the sitemap view as a string
        $sitemapContent = view('sitemap', [
            'keywords' => $formattedKeywords,
        ])->render(); // Ensure rendering as a string

        // Return the response with the correct XML content type
        return response($sitemapContent, 200)
            ->header('Content-Type', 'application/xml');
    }
}
