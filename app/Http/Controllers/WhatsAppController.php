<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    public function sendMessage(Request $request)
    {
        try {
            $phoneNumber = "+51945714598";//$request->input('phone_number');
            $message = $request->input('message');

            $twilioSid ="AC6e85e48c9ce2cb9d9cb87100b4bfcb6c";// config('services.twilio.sid');
            $twilioToken = "f00f89404323435b4a67c681a6e382b2";//config('services.twilio.token');
            $twilioPhoneNumber = "+14155238886";//config('services.twilio.phone_number');

            $twilio = new Client($twilioSid, $twilioToken);

            $twilio->messages->create(
                "whatsapp:{$phoneNumber}",
                [
                    'from' => "whatsapp:{$twilioPhoneNumber}",
                    'body' => $message,
                ]
            );

            return response()->json(['message' => 'Mensaje enviado con éxito']);
        } catch (TwilioException $e) {
            // Captura y devuelve información sobre la excepción de Twilio
            return response()->json(['error' => $e->getMessage(), 'code' => $e->getCode()]);
        } catch (\Exception $e) {
            // Captura y devuelve información sobre otras excepciones
            return response()->json(['error' => $e->getMessage()]);
        }
    }
/*
    public function send()
    {
        $sid    = "AC6e85e48c9ce2cb9d9cb87100b4bfcb6c";
        $token  = "f00f89404323435b4a67c681a6e382b2";
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
        ->create("whatsapp:+51945714598", 
                [
                    'from' => "whatsapp:+14155238886",
                    'body' => $sid,
                ]
        );

        print($message->sid);
    }
*/
}
