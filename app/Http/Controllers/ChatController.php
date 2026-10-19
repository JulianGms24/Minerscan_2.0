<?php

namespace App\Http\Controllers;

use App\Services\ChatbotService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    private const HISTORY_KEY = 'sofia_history';

    // 20 mensajes = los últimos 10 intercambios (pregunta + respuesta).
    private const MAX_HISTORY_MESSAGES = 20;

    public function message(
        Request $request,
        ChatbotService $chatbotService
    ): JsonResponse {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $question = trim($validated['message']);

        // Historial temporal de esta sesión (no se guarda en MySQL).
        $history = session()->get(self::HISTORY_KEY, []);

        if (!is_array($history)) {
            $history = [];
        }

        try {
            // Primero se resuelven las consultas operativas con Laravel/MySQL;
            // el resto lo responde Gemini usando el historial como contexto.
            $response = $chatbotService->getResponse($question, $history);

            $history[] = [
                'role' => 'user',
                'text' => $question,
            ];

            // Las respuestas con datos del sistema (nombres, cantidades) no se
            // guardan en el historial para que no viajen luego a Gemini.
            $history[] = [
                'role' => 'assistant',
                'text' => $chatbotService->lastSource === 'database'
                    ? '[Se respondió con datos del sistema.]'
                    : $this->toPlainText($response),
            ];

            $history = array_slice($history, -self::MAX_HISTORY_MESSAGES);

            session()->put(self::HISTORY_KEY, $history);

            return response()->json([
                'success' => true,
                'response' => $response,
            ]);
        } catch (\Throwable $exception) {
            Log::error('Error al procesar el mensaje de SOFIA.', [
                'exception' => get_class($exception),
                'message' => $exception->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'response' => 'Lo siento, tuve un problema al procesar tu mensaje. Inténtalo nuevamente.',
            ], 500);
        }
    }

    /**
     * Reinicia la conversación (borra el historial de la sesión).
     */
    public function reset(): JsonResponse
    {
        session()->forget(self::HISTORY_KEY);

        return response()->json(['success' => true]);
    }

    private function toPlainText(string $html): string
    {
        $text = preg_replace('#<br\s*/?>\r?\n?#i', "\n", $html) ?? $html;

        return trim(
            html_entity_decode(strip_tags($text), ENT_QUOTES | ENT_HTML5, 'UTF-8')
        );
    }
}