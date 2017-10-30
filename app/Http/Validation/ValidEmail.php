<?php
namespace App\Http\Validation;

use Illuminate\Contracts\Validation\Rule;
use GuzzleHttp\Client as Guzzle;


class ValidEmail implements Rule
{
    protected $message = 'Sry, invalid email address';

    private $guzzle;


    public function __construct(Guzzle $client)
    {
        $this->guzzle = $client;
    }


    public function passes($attribute, $value)
    {
        $response = $this->getMailGunResponse($value);

        if ($response->did_you_mean) {
            $this->message = $this->buildSuggestionMessage($response->did_you_mean);
        }

        return $response->is_valid;
    }

    protected function buildSuggestionMessage($suggestion){
        return "Did you mean {$suggestion}";
    }

    public function message(){
        return $this->message;
    }

    private function getMailGunResponse($address){
        try {
            $request = $this->guzzle->request('GET', 'https://api.mailgun.net/v3/address/validate', [
                'query' => [
                    'api_key' => config('api.mailgun_pub_api_key'),
                    'address' => $address
                ],
                'connect_timeout' => 10
            ]);
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            //if their was a problem connecting to mailgun use standard validation
            //todo implement validation
        }

        return json_decode($request->getBody());
    }
}