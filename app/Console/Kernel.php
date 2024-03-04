<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;
use App\Models\Token;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function(){
            // WorldTrips
            try{
                $response = Http::asForm()->post('https://beta.hccmis.com/iwebapi/authenticatetoken', [
                        'ClientId' => 'ProducerAPI',
                        'Username' => '5943595',
                        'password' => 'k5!96^uT53aE',
                        'grant_type' => 'password',
                ]);
    
                $accessToken = $response['access_token'];

                $token = Token::where('provider', 'World Trips')->first();

                $token->update([
                    'token' => $accessToken
                ]);
            }catch (QueryError $exception) {
                return response()->json($exception->getErrorDetails());
            }

            // Trawick
            try{
                $response = Http::post('https://api.trawickinternational.com/account/authenticateV2', [
                    "username" => "jzglobalins@gmail.com",
                    "password" => "bghaaa12!A"
                ]);
    
                $token = Token::where('provider', 'Trawick')->first();

                $token->update([
                    'token' => $response->json()
                ]);
            }catch (QueryError $exception) {
                return response()->json($exception->getErrorDetails());
            }
        })->everyFifteenMinutes();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
