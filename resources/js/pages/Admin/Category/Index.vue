<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { create, destroy, edit } from '@/routes/admin/categories/index';
import { index as productsIndex } from '@/routes/products/index';

defineProps<{
    categories: {
        id: number;
        name: string;
    }[];
}>();

function confirmDestroy(categoryId: number, categoryName: string): void {
    if (
        !confirm(
            `Delete category "${categoryName}"? Products will be unlinked from it.`,
        )
    ) {
        return;
    }

    router.delete(destroy.url({ category: categoryId }));
}
</script>

<template>
    <Head title="Categories" />

    <AdminLayout>
        <div class="mx-auto max-w-3xl space-y-8 p-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <h1 class="font-display text-2xl font-semibold text-stone-900">
                    Categories
                </h1>
                <Link
                    :href="create()"
                    class="rounded-lg bg-stone-900 px-4 py-2 text-sm font-medium text-white hover:bg-stone-800"
                >
                    Add category
                </Link>
            </div>

            <div
                class="overflow-hidden rounded-2xl border border-stone-200/80 bg-white/80 shadow-sm"
            >
                <table class="min-w-full divide-y divide-stone-200 text-sm">
                    <thead class="bg-stone-50/90">
                        <tr>
                            <th
                                scope="col"
                                class="px-4 py-3 text-left font-medium text-stone-700"
                            >
                                Name
                            </th>
                            <th
                                scope="col"
                                class="px-4 py-3 text-right font-medium text-stone-700"
                            >
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-200">
                        <tr v-if="categories.length === 0">
                            <td
                                colspan="2"
                                class="px-4 py-6 text-center text-stone-500"
                            >
                                No categories yet. Add one above.
                            </td>
                        </tr>
                        <tr
                            v-for="category in categories"
                            v-else
                            :key="category.id"
                        >
                            <td class="px-4 py-3 text-stone-900">
                                {{ category.name }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                <Link
                                    :href="edit({ category: category.id })"
                                    class="mr-2 font-medium text-amber-900 hover:text-amber-950"
                                >
                                    Edit
                                </Link>
                                <button
                                    type="button"
                                    class="font-medium text-red-600 hover:text-red-800"
                                    @click="
                                        confirmDestroy(
                                            category.id,
                                            category.name,
                                        )
                                    "
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p class="mt-8">
                <Link
                    :href="productsIndex()"
                    class="text-sm text-stone-600 underline hover:text-amber-900"
                >
                    ← Back to public products
                </Link>
            </p>
        </div>
    </AdminLayout>
</template>
