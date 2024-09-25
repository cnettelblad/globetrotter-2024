<?php

namespace App\Data\Discord;

use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Dto;

final class DiscordUser extends Dto
{
    #[Computed]
    public ?string $avatar_url;

    public function __construct(
        public int $id,
        public string $username,
        public string $discriminator,
        public ?string $global_name,
        public ?string $avatar,
        public ?bool $bot,
        public ?bool $system,
        public ?bool $mfa_enabled,
        public ?string $banner,
        public ?int $accent_color,
        public ?string $locale,
        public ?bool $verified,
        public ?string $email,
        public ?int $flags,
        public ?int $premium_type,
        public ?int $public_flags,
    ) {
        if ($this->avatar) {
            $this->avatar_url = sprintf(
                "https://cdn.discordapp.com/avatars/%s/%s.png",
                $this->id,
                $this->avatar
            );
        }
    }
}
