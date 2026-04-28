<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';

defineProps<{
    categories: {
        id: number;
        name: string;
    }[];
}>();

function confirmDestroy(categoryId: number, categoryName: string): void {
    if (!confirm(`Delete category "${categoryName}"? This cannot be undone.`)) {
        return;
    }

    router.delete(`/admin/categories/${categoryId}`);
}
</script>

<template>
    <Head title="Categories" />

    <div class="mx-auto max-w-3xl p-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h1 class="text-2xl font-semibold">Categories</h1>
            <Link
                href="/admin/categories/create"
                class="rounded bg-gray-900 px-4 py-2 text-sm text-white"
            >
                Add category
            </Link>
        </div>

        <p v-if="categories.length === 0" class="mt-6 text-gray-600">
            No categories yet. Click "Add category" to create one.
        </p>

        <ul
            v-else
            class="mt-6 divide-y divide-gray-200 rounded border border-gray-200"
        >
            <li
                v-for="category in categories"
                :key="category.id"
                class="flex flex-wrap items-center justify-between gap-3 p-4"
            >
                <span class="font-medium">{{ category.name }}</span>

                <span class="flex flex-wrap gap-2">
                    <Link
                        :href="`/admin/categories/${category.id}/edit`"
                        class="rounded border border-gray-300 px-3 py-1 text-sm"
                    >
                        Edit
                    </Link>
                    <button
                        type="button"
                        class="rounded border border-red-300 px-3 py-1 text-sm text-red-700"
                        @click="confirmDestroy(category.id, category.name)"
                    >
                        Delete
                    </button>
                </span>
            </li>
        </ul>

        <p class="mt-8">
            <Link href="/products" class="text-sm text-gray-600 underline">
                ← Back to public products
            </Link>
        </p>
    </div>
</template>
