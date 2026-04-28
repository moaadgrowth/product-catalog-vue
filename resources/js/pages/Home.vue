<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { index as adminProductsIndex } from '@/routes/admin/products/index';
import { index as productsIndex } from '@/routes/products/index';
</script>

<template>
    <PublicLayout>
        <Head :title="$page.props.name ?? 'Catalog'" />

        <main class="relative mx-auto max-w-3xl px-6 py-16 sm:py-24">
            <p
                class="text-xs font-semibold tracking-[0.2em] text-amber-800/80 uppercase"
            >
                Laravel Inertia
            </p>
            <h1
                class="mt-3 font-display text-4xl leading-tight font-bold text-stone-900 sm:text-5xl"
            >
                Product catalog
            </h1>
            <p class="mt-4 max-w-xl text-base leading-relaxed text-stone-600">
                Browse products on the shop, filter by category, or open the
                admin to manage data.
            </p>

            <ul class="mt-12 grid gap-4 sm:grid-cols-2">
                <li>
                    <Link
                        :href="productsIndex()"
                        class="group flex h-full flex-col rounded-2xl border border-stone-200/80 bg-white/80 p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-amber-300/60 hover:shadow-md"
                    >
                        <span
                            class="text-xs font-semibold tracking-wider text-amber-800/90 uppercase"
                            >Public</span
                        >
                        <span
                            class="mt-2 font-display text-lg font-semibold text-stone-900"
                            >Shop</span
                        >
                        <span class="mt-2 flex-1 text-sm text-stone-600">
                            List and filter products by category.
                        </span>
                        <span
                            class="mt-4 text-sm font-medium text-amber-900 group-hover:underline"
                            >Open shop →</span
                        >
                    </Link>
                </li>
                <li>
                    <Link
                        :href="adminProductsIndex()"
                        class="group flex h-full flex-col rounded-2xl border border-stone-200/80 bg-white/80 p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-amber-300/60 hover:shadow-md"
                    >
                        <span
                            class="text-xs font-semibold tracking-wider text-amber-800/90 uppercase"
                            >Admin</span
                        >
                        <span
                            class="mt-2 font-display text-lg font-semibold text-stone-900"
                            >Dashboard</span
                        >
                        <span class="mt-2 flex-1 text-sm text-stone-600">
                            Manage products and categories.
                        </span>
                        <span
                            class="mt-4 text-sm font-medium text-amber-900 group-hover:underline"
                            >Open admin →</span
                        >
                    </Link>
                </li>
            </ul>
        </main>
    </PublicLayout>
</template>
