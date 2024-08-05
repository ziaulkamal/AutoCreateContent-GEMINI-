<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function generate($any = '')
    {
        // Generate slug from the URL input
        $slug = Str::slug($any); // Using Laravel's Str::slug method

        // Define file path in the public directory
        $filePath = public_path("json/{$slug}.json");

        // Check if the file already exists
        if (file_exists($filePath)) {
            // If the file exists, read the content from the file
            $content = file_get_contents($filePath);
            $data = json_decode($content, true); // Decode JSON content to array
        } else {
            // If the file does not exist, generate new content
            $content = $this->geminiService->generateContent($any);

            // Save the new content to the file
            file_put_contents($filePath, json_encode($content, JSON_PRETTY_PRINT));

            // Prepare response
            $data = $content;
        }

        $cleanedContent = str_replace(["```html", "```"], "", $data);

        $contents = [
            'data' => $cleanedContent
        ];
        // Return the view with the content
        return view('main', $contents);
    }
}
