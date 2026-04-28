<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import {
    index as adminCategoriesIndex,
    store,
} from '@/routes/admin/categories/index';

const form = useForm({
    name: '',
});

const controlClass =
    'w-full rounded-lg border border-stone-300 bg-white px-3 py-2 text-sm text-stone-900 shadow-sm focus:border-amber-600 focus:ring-1 focus:ring-amber-500 focus:outline-none';

function submit(): void {
    form.post(store.url());
}
</script>

<template>
    <Head title="Create Category" />

    <AdminLayout>
        <div class="mx-auto max-w-3xl space-y-8 p-6">
            <h1 class="font-display text-2xl font-semibold text-stone-900">
                New category
            </h1>

            <form
                class="space-y-4 rounded-2xl border border-stone-200/80 bg-white/80 p-5 shadow-sm"
                @submit.prevent="submit"
            >
                <div>
                    <label
                        for="category-name"
                        class="mb-1 block text-sm font-medium text-stone-700"
                    >
                        Name
                    </label>
                    <input
                        id="category-name"
                        v-model="form.name"
                        type="text"
                        autocomplete="off"
                        :class="controlClass"
                    />
                    <p
                        v-if="form.errors.name"
                        class="mt-1 text-sm text-red-600"
                    >
                        {{ form.errors.name }}
                    </p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <button
                        type="submit"
                        class="rounded-lg bg-stone-900 px-4 py-2 text-sm font-medium text-white hover:bg-stone-800 disabled:opacity-50"
                        :disabled="form.processing"
                    >
                        {{ form.processing ? 'Saving…' : 'Add category' }}
                    </button>
                    <Link
                        :href="adminCategoriesIndex()"
                        class="inline-flex items-center rounded-lg border border-stone-300 bg-white/80 px-4 py-2 text-sm font-medium text-stone-700 hover:bg-stone-50"
                    >
                        Cancel
                    </Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
