<?php

namespace App\Services;

use App\Data\Discord\DiscordUser;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\RequestInterface;

class DiscordService
{
    protected const API_BASE = 'https://discord.com/api/';
    protected const API_VERSION = 'v10';
    protected const RATE_LIMIT_CACHE_KEY = 'discord_rate_limit';

    private PendingRequest $http;

    public function __construct(string $token)
    {
        $this->http = Http::baseUrl(self::API_BASE . self::API_VERSION)
            ->withToken($token, 'Bot')
            ->withRequestMiddleware([$this, 'checkRateLimit'])
            ->retry(
                5,
                fn() => Cache::get(self::RATE_LIMIT_CACHE_KEY),
                [$this, 'retryHandler']
            );
    }

    public function getUser(string|int $userId): ?DiscordUser
    {
        try {
            $response = $this->http->get("users/{$userId}");
        } catch (ConnectionException $e) {
            Log::error($e->getMessage());

            return null;
        }

        if (!$response->successful()) {
            return null;
        }

        return DiscordUser::from($response->json());
    }

    public function retryHandler(RequestException $e): bool
    {
        if ($e->response->status() === 429) {
            $retryAfter = $e->response->collect()->get('retry_after');
            $reset = (int) ceil(
                is_numeric($retryAfter) ? (int) $retryAfter : 10
            ) + 1;

            $currentReset = Cache::get(self::RATE_LIMIT_CACHE_KEY);

            if ($currentReset && is_numeric($currentReset)) {
                $reset += (int) $currentReset;
            }

            Cache::put(
                self::RATE_LIMIT_CACHE_KEY,
                $reset,
                $reset
            );

            return true;
        }

        return false;
    }

    public function checkRateLimit(RequestInterface $request): RequestInterface
    {
        $rateLimit = Cache::get(self::RATE_LIMIT_CACHE_KEY);

        if ($rateLimit && is_numeric($rateLimit)) {
            sleep((int) $rateLimit);
        }

        return $request;
    }
}
