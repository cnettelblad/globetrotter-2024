import { reactive } from 'vue'

interface Toast {
    message: string;
    type: 'success' | 'warning' | 'error';
    id: number;
  }

export const toastStore = reactive({
    toasts: [] as Toast[],
    count: 0,

    addToast(
        message: string,
        type: 'success' | 'warning' | 'error' = 'success'
    ) {
      const id = ++this.count;
      this.toasts.push({ message, type, id });

      setTimeout(() => {
        this.removeToast(id);
      }, 10000);
    },

    removeToast(id: number) {
      this.toasts = this.toasts.filter(toast => toast.id !== id);
    },
});
