export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export interface Contestant {
    id: string;
    discord_id: number;
    created_at: string;
    updated_at: string;
    nickname: string;
    username: string;
    avatar: string;
    score: number;
    submissions?: Submission[];
}

export interface Submission {
    id: string;
    image?: string;
    month: string;
    contestant?: Contestant;
    destination?: Destination;
}

export interface Destination {
    id: string;
    name: string;
    emoji: string;
    type: string;
    code: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};
