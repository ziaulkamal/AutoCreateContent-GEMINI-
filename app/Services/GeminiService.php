<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class GeminiService
{
    protected $client;
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $proxy = $this->getProxy();
        $this->client = new Client([
            'proxy' => $proxy,
            // 'proxy' => 'https://your-proxy-server:port', // Jika menggunakan proxy HTTPS
        ]);
        $this->apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent';
        $this->apiKey = env('GEMINI_API_KEY'); // Tambahkan API Key di .env
    }

    protected function getProxy()
    {
        $proxyUrl = 'http://pubproxy.com/api/proxy';
        try {
            $response = file_get_contents($proxyUrl);
            $data = json_decode($response, true);

            // Ambil proxy dari hasil API
            $proxyData = $data['data'][0];
            $proxy = 'http://' . $proxyData['ipPort']; // Sesuaikan jika proxy menggunakan HTTPS

            return $proxy;
        } catch (\Exception $e) {
            // Log error atau handle jika terjadi masalah
            return null;
        }
    }

    public function generateContent($data)
    {
        $requestData = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => "Create a comprehensive article on $data in English with a professional tone, including headings from H1 to H6 based on the context of each paragraph, Structure the article as follows  H1 for the title, H2 for introduction and overview, H3 for detailed explanation of key aspects or benefits, H4 for specific strategies or techniques, H5 for in-depth analysis or examples, and H6 for additional tips or advanced techniques. Include a comparison table with pros and cons for different time management techniques, Each paragraph should contain approximately 2000 words, with a total of 20 paragraphs, Ensure at least 3 outbound links to reputable sources, Provide the article in HTML format, not Markdown, with proper headings, images (including H2 headings, alt tags, and paragraphs), and ensure rich and informative content, Format the content in JSON with title attribute, body attribue, and keywords attribute"
                        ]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.4,
                'topK' => 1,
                'topP' => 1,
                'maxOutputTokens' => 6000,
                'stopSequences' => []
            ],
            'safetySettings' => [
                ['category' => 'HARM_CATEGORY_HARASSMENT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                ['category' => 'HARM_CATEGORY_HATE_SPEECH', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                ['category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                ['category' => 'HARM_CATEGORY_DANGEROUS_CONTENT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE']
            ]
        ];

        try {
            $response = $this->client->post($this->apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'query' => [
                    'key' => $this->apiKey
                ],
                'json' => $requestData
            ]);

            if ($response->getStatusCode() != 200) {
                throw new \Exception('HTTP error! Status: ' . $response->getStatusCode());
            }

            $result = json_decode($response->getBody(), true);

            return $result['candidates'][0]['content']['parts'][0]['text'] ?? 'No content found';
        } catch (RequestException $e) {
            // Log the error or handle it as needed
            return ['error' => $e->getMessage()];
        }
    }
}
