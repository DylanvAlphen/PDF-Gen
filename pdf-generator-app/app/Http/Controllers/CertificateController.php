<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CertificateController extends Controller
{
    public function generateCertificate(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'image' => 'required|url',  
            'signature_name' => 'required|string|max:255',
            'student_name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
        ]);

        $apiToken = env('PDF_API_TOKEN'); 
        $baseUrl = "https://us1.pdfgeneratorapi.com/api/v4"; 
        $workspaceId = env('WORKSPACE_ID'); 
        $templateId = env('TEMPLATE_ID');

        if (!$apiToken || !$workspaceId || !$templateId) {
            return response()->json(['error' => 'API credentials are missing.'], 500);
        }

        $postData = [
            "template" => [
                "id" => (int) $templateId,
                "data" => [
                    "date" => $validated['date'],
                    "image" => $validated['image'],
                    "signature_name" => $validated['signature_name'],
                    "student_name" => $validated['student_name'],
                    "subject" => $validated['subject'],
                ]
            ],
            "format" => "pdf",
            "output" => "url", 
            "name" => "Certificate_" . str_replace(' ', '_', $validated['student_name']),
            "testing" => false
        ];

        $response = Http::withToken($apiToken)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'X-Workspace-Id' => $workspaceId, 
            ])
            ->post("$baseUrl/documents/generate", $postData);

        Log::info('PDF API Response:', $response->json());

        if ($response->failed()) {
            return response()->json([
                'error' => 'Failed to generate certificate',
                'details' => $response->json()
            ], $response->status());
        }

        return response()->json($response->json());
    }
}
