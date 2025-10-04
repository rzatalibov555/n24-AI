<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Openai {

    private $api_key;
    private $endpoint = "https://openrouter.ai/api/v1/chat/completions";

    public function __construct() {
        $this->api_key = "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"; // OpenRouter API key buraya
    }

    public function ask($message, $model = "openai/gpt-3.5-turbo") {
        $ch = curl_init();

        $data = [
            "model" => $model,
            "messages" => [
                ["role" => "system", "content" => "You are a helpful assistant."],
                ["role" => "user", "content" => $message]
            ],
            "temperature" => 0.7
        ];

        curl_setopt($ch, CURLOPT_URL, $this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . $this->api_key,
            "Content-Type: application/json",
            "HTTP-Referer: http://localhost", // OpenRouter tələb edir
            "X-Title: My CI3 App"             // OpenRouter tələb edir
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return "Curl error: " . curl_error($ch);
        }

        curl_close($ch);

        $result = json_decode($response, true);

        if (isset($result['choices'][0]['message']['content'])) {
            return $result['choices'][0]['message']['content'];
        } else {
            return "API cavabı yoxdur: " . json_encode($result);
        }
    }





    // embed metodu: Metinə əsasən gömülü vektörü əldə edir.

    public function embed($text, $model = "openai/text-embedding-3-small") {
    $ch = curl_init();

    $data = [
        "model" => $model,
        "input" => $text
    ];

    curl_setopt($ch, CURLOPT_URL, "https://openrouter.ai/api/v1/embeddings");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer " . $this->api_key,
        "Content-Type: application/json",
        "HTTP-Referer: http://localhost",
        "X-Title: My CI3 App"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        return "Curl error: " . curl_error($ch);
    }

    curl_close($ch);
    $result = json_decode($response, true);

    return $result['data'][0]['embedding'] ?? null;
}
}















// class Openai
// {

//     private $api_key;
//     private $endpoint = "https://api.openai.com/v1/chat/completions";

//     public function __construct()
//     {
//         $this->api_key = ""; // Burada API key-i yaz

//     }

//     public function ask($message, $model = "gpt-3.5-turbo")
//     {
//         $ch = curl_init();

//         $data = [
//             "model" => $model,
//             "messages" => [
//                 ["role" => "system", "content" => "You are a helpful assistant."],
//                 ["role" => "user", "content" => $message]
//             ],
//             "temperature" => 0.7
//         ];

//         curl_setopt($ch, CURLOPT_URL, $this->endpoint);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_POST, true);
//         curl_setopt($ch, CURLOPT_HTTPHEADER, [
//             "Authorization: Bearer " . $this->api_key,
//             "Content-Type: application/json"
//         ]);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

//         $response = curl_exec($ch);

//         if (curl_errno($ch)) {
//             return "Curl error: " . curl_error($ch);
//         }

//         curl_close($ch);

//         $result = json_decode($response, true);

//         // return $result['choices'][0]['message']['content'] ?? "No response";
//         if (isset($result['choices'][0]['message']['content'])) {
//             return $result['choices'][0]['message']['content'];
//         } else {
//             return "API cavabı yoxdur: " . json_encode($result);
//         }
//     }
// }
