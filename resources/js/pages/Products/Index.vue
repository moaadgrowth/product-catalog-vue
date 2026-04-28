<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { index as productsIndex } from '@/routes/products/index';

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

const props = defineProps<{
    products: Product[];
    categories: Category[];
    categoryFilter: number | null;
}>();

function categoryLabel(product: Product): string {
    const names = product.categories.map((c) => c.name);

    return names.length ? names.join(', ') : '—';
}

function onCategoryChange(event: Event): void {
    const value = (event.target as HTMLSelectElement).value;

    if (value === '') {
        router.visit(productsIndex.url());

        return;
    }

    router.visit(productsIndex.url({ query: { category: Number(value) } }));
}
</script>

<template>
    <PublicLayout>
        <Head title="Products" />

        <div class="mx-auto max-w-3xl space-y-6 p-6">
            <h1 class="font-display text-2xl font-semibold text-stone-900">
                Products
            </h1>

            <div>
                <label
                    for="category"
                    class="mb-1 block text-sm font-medium text-stone-700"
                >
                    Category
                </label>

                <select
                    id="category"
                    class="w-full rounded-lg border border-stone-300 bg-white px-3 py-2 text-sm text-stone-900 shadow-sm focus:border-amber-600 focus:ring-1 focus:ring-amber-500 focus:outline-none"
                    :value="props.categoryFilter ?? ''"
                    @change="onCategoryChange"
                >
                    <option value="">All categories</option>
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="String(category.id)"
                    >
                        {{ category.name }}
                    </option>
                </select>
            </div>

            <ul
                class="divide-y divide-stone-200 overflow-hidden rounded-2xl border border-stone-200/80 bg-white/80 shadow-sm"
            >
                <template v-if="products.length === 0">
                    <li class="px-4 py-6 text-sm text-stone-500">
                        No products match this filter.
                    </li>
                </template>
                <li
                    v-for="product in products"
                    v-else
                    :key="product.id"
                    class="flex flex-col gap-1 px-4 py-3"
                >
                    <span class="font-medium text-stone-900">{{
                        product.name
                    }}</span>
                    <span class="text-sm text-stone-600">{{
                        categoryLabel(product)
                    }}</span>
                    <span class="text-sm text-stone-800"
                        >{{ product.price }} SEK</span
                    >
                </li>
            </ul>
        </div>
    </PublicLayout>
</template>
