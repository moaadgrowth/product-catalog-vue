<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import {
    index as adminProductsIndex,
    update,
} from '@/routes/admin/products/index';

interface Category {
    id: number;
    name: string;
}

const props = defineProps<{
    product: {
        id: number;
        name: string;
        description: string | null;
        price: string;
        categories: {
            id: number;
            name: string;
        }[];
    };
    categories: Category[];
}>();

const form = useForm({
    name: props.product.name,
    description: props.product.description ?? '',
    price: props.product.price,
    categoryIds: props.product.categories.map((c) => c.id),
});

const controlClass =
    'w-full rounded-lg border border-stone-300 bg-white px-3 py-2 text-sm text-stone-900 shadow-sm focus:border-amber-600 focus:ring-1 focus:ring-amber-500 focus:outline-none';

function submit(): void {
    form.put(update.url({ product: props.product.id }));
}
</script>

<template>
    <Head title="Edit Product" />

    <AdminLayout>
        <div class="mx-auto max-w-4xl space-y-8 p-6">
            <h1 class="font-display text-2xl font-semibold text-stone-900">
                Edit product
            </h1>

            <form
                class="space-y-4 rounded-2xl border border-stone-200/80 bg-white/80 p-5 shadow-sm"
                @submit.prevent="submit"
            >
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label
                            for="product-name"
                            class="mb-1 block text-sm font-medium text-stone-700"
                        >
                            Name
                        </label>
                        <input
                            id="product-name"
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

                    <div class="sm:col-span-2">
                        <label
                            for="product-description"
                            class="mb-1 block text-sm font-medium text-stone-700"
                        >
                            Description
                        </label>
                        <textarea
                            id="product-description"
                            v-model="form.description"
                            rows="3"
                            :class="controlClass"
                        ></textarea>
                        <p
                            v-if="form.errors.description"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.description }}
                        </p>
                    </div>

                    <div>
                        <label
                            for="product-price"
                            class="mb-1 block text-sm font-medium text-stone-700"
                        >
                            Price
                        </label>
                        <input
                            id="product-price"
                            v-model="form.price"
                            type="text"
                            inputmode="decimal"
                            :class="controlClass"
                        />
                        <p
                            v-if="form.errors.price"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.price }}
                        </p>
                    </div>

                    <div>
                        <span
                            class="mb-2 block text-sm font-medium text-stone-700"
                        >
                            Categories
                        </span>
                        <div
                            class="max-h-40 space-y-2 overflow-y-auto rounded-lg border border-stone-300 bg-white p-3 shadow-sm sm:max-w-md"
                        >
                            <label
                                v-for="category in categories"
                                :key="category.id"
                                class="flex cursor-pointer items-center gap-2 text-sm text-stone-800"
                            >
                                <input
                                    type="checkbox"
                                    :value="category.id"
                                    v-model="form.categoryIds"
                                    class="rounded border-stone-300 text-amber-800 focus:ring-amber-500"
                                />
                                <span>{{ category.name }}</span>
                            </label>
                        </div>
                        <p
                            v-if="form.errors.categoryIds"
                            class="mt-1 text-sm text-red-600"
                        >
                            {{ form.errors.categoryIds }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-2">
                    <button
                        type="submit"
                        class="rounded-lg bg-stone-900 px-4 py-2 text-sm font-medium text-white hover:bg-stone-800 disabled:opacity-50"
                        :disabled="form.processing"
                    >
                        {{ form.processing ? 'Updating…' : 'Update product' }}
                    </button>
                    <Link
                        :href="adminProductsIndex()"
                        class="inline-flex items-center rounded-lg border border-stone-300 bg-white/80 px-4 py-2 text-sm font-medium text-stone-700 hover:bg-stone-50"
                    >
                        Cancel
                    </Link>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>
