<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Contestant extends Model
{
    use HasUuids;

    protected $fillable = [
        'discord_id',
        'username',
        'nickname',
        'avatar'
    ];

    protected $appends = [
        'score'
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::updating(function (self $contestant) {
            if ($contestant->isDirty('avatar')) {
                Storage::delete($contestant->getOriginal('avatar'));
            }
        });
    }

    /**
     * Convert the avatar attribute to a full discord URL.
     */
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: function (string|null $avatar) {
                return $avatar
                    ? Storage::url($avatar)
                    : '/default_avatar.png';
            }
        );
    }

    /**
     * Get the contestant score based on the number of submissions.
     */
    public function score(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->submissions()->count();
            }
        );
    }

    /**
     * Get the submissions for the contestant.
     *
     * @return HasMany<Submission>
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    /**
     * Update the contestant's information from Discord.
     */
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

    /**
     * Create a new contestant from a Discord ID.
     */
    public static function fromDiscordId(int $id): self
    {
        $response = self::fetchDiscordUser($id)->json();

        return self::create([
            'discord_id' => $id,
            'username' => $response['username'],
            'nickname' => $response['global_name'] ?? null,
            'avatar' => $response['avatar']
                ? self::downloadDiscordAvatar($id, $response['avatar'])
                : null
        ]);
    }

    /**
     * Fetch a Discord user by ID.
     */
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

    private static function downloadDiscordAvatar(
        int|string $id,
        string $avatar
    ): ?string {
        $response = Http::get("https://cdn.discordapp.com/avatars/{$id}/{$avatar}.png");

        if (!$response->ok()) {
            return null;
        }

        $path = "avatars/{$avatar}.png";

        Storage::put(
            $path,
            $response->body()
        );

        return $path;
    }
}
