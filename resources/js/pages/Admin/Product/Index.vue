<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

// Later you'll receive props from Laravel, e.g.:
// defineProps<{ products: Product[] }>();
</script>

<template>
    <Head title="Admin Products" />

    <div class="p-6">
        <h1 class="text-2xl font-semibold">Admin product list</h1>
        <p class="mt-2 text-gray-600">
            Placeholder — real list comes in the next checklist.
        </p>
    </div>
</template>
