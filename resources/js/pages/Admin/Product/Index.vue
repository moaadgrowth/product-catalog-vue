<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import { index as adminCategoriesIndex } from '@/routes/admin/categories/index';
import { create, destroy, edit } from '@/routes/admin/products/index';

interface ProductRow {
    id: number;
    name: string;
    description: string | null;
    price: string;
    categories: { id: number; name: string }[];
}

defineProps<{
    products: ProductRow[];
}>();

function categoryLabel(product: ProductRow): string {
    const names = product.categories.map((c) => c.name);

    return names.length ? names.join(', ') : '—';
}

function confirmDestroy(productId: number, productName: string): void {
    if (!confirm(`Delete product "${productName}"? This cannot be undone.`)) {
        return;
    }

    router.delete(destroy.url({ product: productId }));
}
</script>

<template>
    <Head title="Products" />

    <AdminLayout>
        <div class="mx-auto max-w-4xl space-y-8 p-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <h1 class="font-display text-2xl font-semibold text-stone-900">
                    Products
                </h1>
                <Link
                    :href="create()"
                    class="rounded-lg bg-stone-900 px-4 py-2 text-sm font-medium text-white hover:bg-stone-800"
                >
                    Add product
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
                                class="px-4 py-3 text-left font-medium text-stone-700"
                            >
                                Categories
                            </th>
                            <th
                                scope="col"
                                class="px-4 py-3 text-right font-medium text-stone-700"
                            >
                                Price
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
                        <tr v-if="products.length === 0">
                            <td
                                colspan="4"
                                class="px-4 py-6 text-center text-stone-500"
                            >
                                No products yet. Add one above.
                            </td>
                        </tr>
                        <tr
                            v-for="product in products"
                            v-else
                            :key="product.id"
                        >
                            <td class="px-4 py-3 text-stone-900">
                                {{ product.name }}
                            </td>
                            <td class="px-4 py-3 text-stone-600">
                                {{ categoryLabel(product) }}
                            </td>
                            <td class="px-4 py-3 text-right text-stone-900">
                                {{ product.price }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                <Link
                                    :href="edit({ product: product.id })"
                                    class="mr-2 font-medium text-amber-900 hover:text-amber-950"
                                >
                                    Edit
                                </Link>
                                <button
                                    type="button"
                                    class="font-medium text-red-600 hover:text-red-800"
                                    @click="
                                        confirmDestroy(product.id, product.name)
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
                    :href="adminCategoriesIndex()"
                    class="text-sm text-stone-600 underline hover:text-amber-900"
                >
                    ← Back to categories
                </Link>
            </p>
        </div>
    </AdminLayout>
</template>
