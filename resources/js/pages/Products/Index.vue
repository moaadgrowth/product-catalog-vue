<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

interface Category {
    id: number;
    name: string;
}

interface Product {
    id: number;
    name: string;
    description: string | null;
    price: string;
    categories: Category[];
}

defineProps<{
    products: Product[];
    categories: Category[];
    categoryFilter: number | null;
}>();
</script>

<template>
    <Head title="Products" />

    <div class="mx-auto max-w-4xl p-6">
        <h1 class="text-2xl font-semibold">Products</h1>

        <!-- Filter: “All” + each category (same routes your controller expects) -->
        <nav class="mt-4 flex flex-wrap gap-2">
            <Link
                href="/products"
                class="rounded border px-3 py-1 text-sm"
                :class="
                    categoryFilter === null
                        ? 'border-gray-900 bg-gray-100'
                        : 'border-gray-300 bg-white'
                "
            >
                All
            </Link>

            <Link
                v-for="category in categories"
                :key="category.id"
                :href="`/products?category=${category.id}`"
                class="rounded border px-3 py-1 text-sm"
                :class="
                    categoryFilter === category.id
                        ? 'border-gray-900 bg-gray-100'
                        : 'border-gray-300 bg-white'
                "
            >
                {{ category.name }}
            </Link>
        </nav>

        <!-- Product list -->
        <ul class="mt-8 space-y-4">
            <li v-if="products.length === 0" class="text-gray-500">
                No products match this filter.
            </li>

            <li
                v-for="product in products"
                :key="product.id"
                class="rounded border border-gray-200 p-4"
            >
                <div class="font-medium">{{ product.name }}</div>
                <div class="text-sm text-gray-600">{{ product.price }}</div>
                <p
                    v-if="product.description"
                    class="mt-2 text-sm text-gray-700"
                >
                    {{ product.description }}
                </p>
                <div class="mt-2 flex flex-wrap gap-1">
                    <span
                        v-for="cat in product.categories"
                        :key="cat.id"
                        class="rounded-full bg-gray-100 px-2 py-0.5 text-xs text-gray-700"
                    >
                        {{ cat.name }}
                    </span>
                </div>
            </li>
        </ul>
    </div>
</template>
