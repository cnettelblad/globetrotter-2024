import {
    MaybeRef,
    onMounted,
    onUnmounted,
    Ref,
    ref
} from "vue";

/**
 * Provides a reactive boolean value that can be used
 * to toggle the visibility of an element.
 *
 * @param {MaybeRef<boolean>} defaultState
 * @returns {Ref<boolean>}
 */
export function useOpen(
    defaultState: MaybeRef<boolean> = false
): Ref<boolean> {
    const state = ref(defaultState);

    const closeOnEscape = (e: KeyboardEvent) => {
        if (state && e.key === 'Escape') {
            state.value = false;
        }
    };

    onMounted(() => document.addEventListener('keydown', closeOnEscape));
    onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

    return state;
}
