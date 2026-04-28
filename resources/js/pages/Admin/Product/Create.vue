<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

interface Category {
    id: number;
    name: string;
}

defineProps<{
    categories: Category[];
}>();

const form = useForm({
    name: '',
    description: '',
    price: '',
    categoryIds: [] as number[],
});

function submit(): void {
    form.post('/admin/products');
}
</script>

<template>
    <Head title="Create Product" />

    <div class="mx-auto max-w-md p-6">
        <h1 class="text-xl font-semibold">New product</h1>

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
            <details class="rounded border border-gray-200 p-3">
                <summary
                    class="cursor-pointer text-sm font-medium text-gray-700"
                >
                    Categories
                    <span class="ml-2 text-xs font-normal text-gray-500">
                        ({{ form.categoryIds.length }} selected)
                    </span>
                </summary>

                <div class="mt-3 max-h-48 space-y-2 overflow-y-auto pr-1">
                    <label
                        v-for="category in categories"
                        :key="category.id"
                        class="flex cursor-pointer items-center gap-2 text-sm"
                    >
                        <input
                            type="checkbox"
                            :value="category.id"
                            v-model="form.categoryIds"
                            class="rounded border-gray-300"
                        />
                        <span>{{ category.name }}</span>
                    </label>
                </div>
            </details>

            <p v-if="form.errors.categoryIds" class="mt-1 text-sm text-red-600">
                {{ form.errors.categoryIds }}
            </p>

            <button
                type="submit"
                class="rounded bg-gray-900 px-4 py-2 text-white disabled:opacity-50"
                :disabled="form.processing"
            >
                {{ form.processing ? 'Saving…' : 'Create' }}
            </button>
        </form>
    </div>
</template>
