<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    category: {
        id: number;
        name: string;
    };
}>();

const form = useForm({
    name: props.category.name,
});

function submit(): void {
    form.put(`/admin/categories/${props.category.id}`);
}
</script>

<template>
    <Head title="Edit Category" />

    <div class="mx-auto max-w-md p-6">
        <h1 class="text-xl font-semibold">Edit category</h1>

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
