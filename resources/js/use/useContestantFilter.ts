import { Contestant } from "@/types";
import { levenshtein } from "@/utils/levenshtein";
import { computed, MaybeRef, ref, Ref } from "vue";

type ContestantMatch = {
    matches: {
        nickname: number | null;
        username: number | null;
        discord_id: number | null;
    };
    contestant: Contestant;
} | undefined;

export const useContestantFilter = (
    initialFilter: MaybeRef<string> = '',
    initialContestants: MaybeRef<Contestant[]> = [],
) => {
    const filter = ref(initialFilter);
    const contestants = ref(initialContestants);

    const filteredContestants = computed((): Contestant[] => {
        if (!filter.value) {
            return contestants.value;
        }

        return contestants.value.map((c) => getContestantMatch(c, filter.value))
            .filter(Boolean)
            .sort(sortContestantByMatch)
            .map((result) => result?.contestant) as Contestant[];
    });

    return { filter, contestants, filteredContestants };
}

const sortContestantByMatch = (a: ContestantMatch, b: ContestantMatch) => {
    if (!a || !b) {
        return 0;
    }

    let aValue = 0;
    let bValue = 0;

    if (a.matches.nickname !== null) {
        aValue = a.matches.nickname;
    } else if (a.matches.username !== null) {
        aValue = a.matches.username + 2;
    } else if (a.matches.discord_id !== null) {
        aValue = a.matches.discord_id + 5;
    }

    if (b.matches.nickname !== null) {
        bValue = b.matches.nickname;
    } else if (b.matches.username !== null) {
        bValue = b.matches.username + 2;
    } else if (b.matches.discord_id !== null) {
        bValue = b.matches.discord_id + 5;
    }

    if (aValue === bValue) {
        return 0;
    }

    return (aValue > bValue) ? 1 : -1;
};

const getContestantMatch = (contestant: Contestant, filter: string): ContestantMatch => {
    const searchValue = filter.toLowerCase();

    const nickname = contestant.nickname?.toLowerCase();
    const username = contestant.username.toLowerCase();
    const discordId = contestant.discord_id.toString();

    const nicknameMatch = nickname?.includes(searchValue);
    const usernameMatch = username.includes(searchValue);
    const discordIdMatch = discordId.includes(searchValue);

    if (!nicknameMatch && !usernameMatch && !discordIdMatch) {
        return;
    }

    const nicknameDistance = nickname && nicknameMatch
        ? levenshtein(nickname, searchValue)
        : null;
    const usernameDistance = username && usernameMatch
        ? levenshtein(username, searchValue)
        : null;
    const discordIdDistance = discordId && discordIdMatch
        ? levenshtein(discordId, searchValue)
        : null;

    return {
        matches: {
            nickname: nicknameDistance,
            username: usernameDistance,
            discord_id: discordIdDistance,
        },
        contestant,
    }
}
