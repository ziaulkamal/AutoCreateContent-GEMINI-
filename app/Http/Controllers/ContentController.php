<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function generate($any = '')
{
    // Generate slug from the URL input
    $slug = Str::slug($any);

    // Define file path in the public directory
    $filePath = public_path("json/{$slug}.json");

    // Check if the file already exists
    if (file_exists($filePath)) {
        // If the file exists, read the content from the file
        $content = file_get_contents($filePath);
        $data = json_decode($content, true); // Decode JSON content to array
    } else {
        // If the file does not exist, generate new content from Vercel endpoint
        $client = new Client();
        $apiUrl = 'https://vercel-gemini-psi.vercel.app/api/generate-content';

        try {
            $response = $client->request('GET', $apiUrl, [
                'query' => [
                    'key' => $any,
                ],
                'timeout' => 60 // Waktu tunggu (dalam detik)
            ]);

            if ($response->getStatusCode() != 200) {
                throw new \Exception('HTTP error! Status: ' . $response->getStatusCode());
            }

            $content = json_decode($response->getBody(), true);

            // Save the new content to file
            file_put_contents($filePath, json_encode($content, JSON_PRETTY_PRINT));

            // Prepare response
            $data = $content;
        } catch (RequestException $e) {
            // Handle error as needed
            return response()->json(['error' => 'Failed to generate content'], 500);
        }
    }

    // Clean up the content if needed (example assumes HTML content)
    $cleanedContent = str_replace(["```html", "```"], "", $data);

    $contents = [
        'data' => $cleanedContent
    ];

    // Return the view with the content
    return view('main', $contents);
}
}
