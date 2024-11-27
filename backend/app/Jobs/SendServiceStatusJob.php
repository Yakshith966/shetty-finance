<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendServiceStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $phoneNumber;
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phoneNumber, $message)
    {
        $this->phoneNumber = $phoneNumber;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $instance_id = env('ZAPLY_INSTANCE_ID');
            $api_token = env('ZAPLY_API_TOKEN');   
            $response = Http::withToken($api_token) 
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post("https://api.zaply.dev/v1/instance/{$instance_id}/message/send", [
                    'message' => $this->message,
                    'number' => $this->phoneNumber,
                ]);

            if (!$response->successful()) {
                Log::error("Failed to send WhatsApp message", [
                    'phone_number' => $this->phoneNumber,
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error("An error occurred while sending WhatsApp message", [
                'phone_number' => $this->phoneNumber,
                'error' => $e->getMessage(),
            ]);
        }
    }

}
