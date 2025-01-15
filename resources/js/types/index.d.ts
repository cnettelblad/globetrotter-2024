export interface ResourceCollection<T> {
    data: T[];
    meta?: {
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
    };
    links?: {
        first?: string;
        last?: string;
        prev?: string;
        next?: string;
    };
}

export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
}

export interface Contestant {
    id: string;
    discord_id: string;
    created_at: string;
    updated_at: string;
    nickname: string | undefined;
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

export interface ImportFailure {
    id: string;
    key: string;
    value: string;
    error: string;
    contestant?: Contestant;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};
