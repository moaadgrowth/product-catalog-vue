<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

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
function submit(): void {
    form.put(`/admin/products/${props.product.id}`);
}
</script>

<template>
    <Head title="Edit Product" />

    <div class="mx-auto max-w-md p-6">
        <h1 class="text-xl font-semibold">Edit product</h1>

        <form class="mt-4 space-y-4" @submit.prevent="submit">
            <div>
                <label for="name">Name</label>
                <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 w-full rounded border px-3 py-2"
                />
                <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">
                    {{ form.errors.name }}
                </p>
            </div>

            <div>
                <label for="description">Description</label>
                <textarea
                    id="description"
                    v-model="form.description"
                    class="mt-1 w-full rounded border px-3 py-2"
                ></textarea>
                <p
                    v-if="form.errors.description"
                    class="mt-1 text-sm text-red-600"
                >
                    {{ form.errors.description }}
                </p>
            </div>
            <div>
                <label for="price">Price</label>
                <input
                    id="price"
                    v-model="form.price"
                    type="number"
                    step="0.01"
                    class="mt-1 w-full rounded border px-3 py-2"
                />
                <p v-if="form.errors.price" class="mt-1 text-sm text-red-600">
                    {{ form.errors.price }}
                </p>
            </div>
            <div>
                <label for="categoryIds">Categories</label>
                <select
                    id="categoryIds"
                    v-model="form.categoryIds"
                    multiple
                    class="mt-1 w-full rounded border px-3 py-2"
                >
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.name }}
                    </option>
                </select>
                <p
                    v-if="form.errors.categoryIds"
                    class="mt-1 text-sm text-red-600"
                >
                    {{ form.errors.categoryIds }}
                </p>
            </div>
            <button
                type="submit"
                class="rounded bg-gray-900 px-4 py-2 text-white disabled:opacity-50"
                :disabled="form.processing"
            >
                {{ form.processing ? 'Updating…' : 'Update' }}
            </button>
        </form>
    </div>
</template>
