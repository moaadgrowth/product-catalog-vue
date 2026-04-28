<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';

defineProps<{
    products: {
        id: number;
        name: string;
        description: string | null;
        price: string;
        categories: {
            id: number;
            name: string;
        }[];
    }[];
}>();

function confirmDestroy(productId: number, productName: string): void {
    if (!confirm(`Delete product "${productName}"? This cannot be undone.`)) {
        return;
    }

    router.delete(`/admin/products/${productId}`);
}
</script>

<template>
    <Head title="Products" />

    <div class="mx-auto max-w-3xl p-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h1 class="text-2xl font-semibold">Products</h1>
            <Link
                href="/admin/products/create"
                class="rounded bg-gray-900 px-4 py-2 text-sm text-white"
            >
                Add product
            </Link>
        </div>

        <p v-if="products.length === 0" class="mt-6 text-gray-600">
            No products yet. Click "Add product" to create one.
        </p>

        <ul
            v-else
            class="mt-6 divide-y divide-gray-200 rounded border border-gray-200"
        >
            <li
                v-for="product in products"
                :key="product.id"
                class="flex flex-wrap items-center justify-between gap-3 p-4"
            >
                <span class="font-medium">{{ product.name }}</span>
                <span class="text-sm text-gray-600">{{ product.price }}</span>
                <div class="mt-2 flex flex-wrap gap-1">
                    <span
                        v-for="category in product.categories"
                        :key="category.id"
                        class="rounded-full bg-gray-100 px-2 py-0.5 text-xs text-gray-700"
                    >
                        {{ category.name }}
                    </span>
                </div>
                <span class="flex flex-wrap gap-2">
                    <Link
                        :href="`/admin/products/${product.id}/edit`"
                        class="rounded border border-gray-300 px-3 py-1 text-sm"
                    >
                        Edit
                    </Link>
                    <button
                        type="button"
                        class="rounded border border-red-300 px-3 py-1 text-sm text-red-700"
                        @click="confirmDestroy(product.id, product.name)"
                    >
                        Delete
                    </button>
                </span>
            </li>
        </ul>

        <p class="mt-8">
            <Link
                href="/admin/categories"
                class="text-sm text-gray-600 underline"
            >
                ← Back to categories
            </Link>
        </p>
    </div>
</template>
