<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { index as adminProductsIndex } from '@/routes/admin/products/index';
import { home } from '@/routes/index';
import { index as productsIndex } from '@/routes/products/index';
</script>

<template>
    <div
        class="font-sans min-h-screen bg-stone-100 text-stone-900 antialiased"
    >
        <header
            class="relative z-10 border-b border-stone-200/80 bg-white/70 backdrop-blur"
        >
            <div
                class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-4 px-6 py-4"
            >
                <Link
                    :href="home()"
                    class="font-display text-lg font-semibold text-stone-900 hover:text-amber-950"
                >
                    Catalog
                </Link>

                <nav
                    class="flex flex-wrap gap-x-6 gap-y-2 text-sm font-medium text-stone-600"
                >
                    <Link :href="productsIndex()" class="hover:text-amber-900">
                        Shop
                    </Link>
                    <Link
                        :href="adminProductsIndex()"
                        class="hover:text-amber-900"
                    >
                        Admin
                    </Link>
                </nav>
            </div>
        </header>

        <div class="relative z-10">
            <slot />
        </div>
    </div>
</template>