<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Submission extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'discord_id',
        'month',
        'submission',
        'image'
    ];

    protected $appends = [
        'nickname',
        'username',
        'avatar'
    ];

    protected function nickname(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->discordUser()->get('global_name') ?: $this->discordUser()->get('username', 'Unknown');
            }
        );
    }

    protected function username(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->discordUser()->get('username', 'Unknown');
            }
        );
    }

    protected function avatar(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->discordUser()->has('avatar') && $this->discordUser()->get('avatar')
                    ? "https://cdn.discordapp.com/avatars/{$this->discord_id}/{$this->discordUser()->get('avatar')}.png"
                    : 'https://cdn.discordapp.com/embed/avatars/0.png';
            }
        );
    }

    private function discordUser(): Collection
    {
        return Cache::remember(
            "discord_user_{$this->discord_id}",
            now()->addDay(),
            function () {
                $url = "https://discord.com/api/v10/users/{$this->discord_id}";
                $response = Http::withHeaders([
                    'Authorization' => 'Bot ' . env('DISCORD_BOT_TOKEN'),
                    'Content-Type' => 'application/json'
                ])->get($url);
                return collect($response->json());
            }
        );
    }
}
