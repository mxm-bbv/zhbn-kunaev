<?php

namespace App\Services;

use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class ReCaptchaService
{
    private ?array $config;
    private Client $client;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->config = $this->getConfig();

        if (!$this->config) {
            throw new Exception("ReCaptcha: No Config specified");
        }

        if (!isset($this->config['secret'])) {
            throw new Exception("ReCaptcha: No secret has been specified");
        }

        $this->setClient();
    }

    private function setClient(): void
    {
        $this->client = new Client([
            'base_uri' => 'https://www.google.com/recaptcha/api/',
        ]);
    }

    private function getConfig(): ?array
    {
        return config('services.google.recaptcha');
    }

    private function parseResponse(ResponseInterface $response)
    {
        return json_decode(
            $response->getBody()->getContents(),
            true,
            512
        );
    }

    /**
     * @param string $response
     * @return mixed
     * @throws GuzzleException
     */
    public function verify(string $response): object
    {
        $response = $this->parseResponse(
            $this->client->post('siteverify', [
                'form_params' => [
                    'secret' => $this->config['secret'],
                    'response' => $response,
                ]
            ])
        );

        return new class($response) {
            public function __construct(private readonly array $response)
            {
            }

            public function getResponse(): array
            {
                return $this->response;
            }

            public function getSuccess(): bool
            {
                return $this->response['success'] ?? false;
            }

            public function getChallengeTs(): Carbon
            {
                return Carbon::parse($this->response['challenge_ts'] ?? time());
            }

            public function getHostName(): ?string
            {
                return $this->response['hostname'] ?? null;
            }

            public function getErrorCodes(): ?array
            {
                return $this->response['error-codes'] ?? null;
            }
        };
    }
}
