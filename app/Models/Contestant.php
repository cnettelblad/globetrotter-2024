<?php

namespace App\Models;

use App\Data\Discord\DiscordUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Contestant extends Model
{
    use HasUuids, HasFactory;

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
     * Create or update a contestant from a Discord user.
     *
     * @param DiscordUser $user
     * @return self
     */
    public static function fromDiscordUser(DiscordUser $user): self
    {
        return self::updateOrCreate(
            [
                'discord_id' => $user->id
            ],
            [
                'username' => $user->username,
                'nickname' => $user->global_name,
                'avatar' => $user->avatar
                    ? self::downloadDiscordAvatar($user->id, $user->avatar)
                    : null
            ]
        );
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
