<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
});

function submit(): void {
    form.post('/admin/categories');
}
</script>

<template>
    <Head title="Create Category" />

    <div class="mx-auto max-w-md p-6">
        <h1 class="text-xl font-semibold">New category</h1>

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
                {{ form.processing ? 'Saving…' : 'Create' }}
            </button>
        </form>
    </div>
</template>
