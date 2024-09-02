<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Contestant extends Model
{
    use HasUuids;

    protected $fillable = [
        'discord_id',
        'username',
        'nickname',
        'avatar'
    ];

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: function (string|null $avatar) {
                return $avatar
                    ? "https://cdn.discordapp.com/avatars/{$this->discord_id}/{$avatar}.png"
                    : 'https://cdn.discordapp.com/embed/avatars/0.png';
            }
        );
    }


    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    public function updateFromDiscord(): self
    {
        $response = self::fetchDiscordUser($this->discord_id)->json();

        $this->update([
            'username' => $response['username'],
            'nickname' => $response['global_name'] ?? null,
            'avatar' => $response['avatar'] ?? null
        ]);

        return $this;
    }

    public static function fromDiscordId(int $id): self
    {
        $response = self::fetchDiscordUser($id)->json();

        return self::create([
            'discord_id' => $id,
            'username' => $response['username'],
            'nickname' => $response['global_name'] ?? null,
            'avatar' => $response['avatar'] ?? null
        ]);
    }

    private static function fetchDiscordUser(int|string $id): Response
    {
        $url = "https://discord.com/api/v10/users/{$id}";

        return Http::withHeaders([
            'Authorization' => 'Bot ' . env('DISCORD_BOT_TOKEN'),
            'Content-Type' => 'application/json'
        ])->retry(
            3,
            1000,
            fn(RequestException $e) => $e->response->status() === 429
        )->get($url);
    }
}
