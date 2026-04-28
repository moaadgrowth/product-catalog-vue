<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { index as adminCategoriesIndex } from '@/routes/admin/categories/index';
import { dashboard } from '@/routes/admin/index';
import { index as adminProductsIndex } from '@/routes/admin/products/index';
import { index as productsIndex } from '@/routes/products/index';
</script>

<template>
    <div class="min-h-screen bg-stone-100 font-sans text-stone-900 antialiased">
        <header
            class="relative z-10 border-b border-stone-200/80 bg-white/70 backdrop-blur"
        >
            <div
                class="mx-auto flex max-w-5xl flex-wrap items-center justify-between gap-4 px-6 py-4"
            >
                <Link
                    :href="dashboard()"
                    class="font-display text-lg font-semibold text-stone-900 hover:text-amber-950"
                >
                    Admin
                </Link>

                <nav
                    class="flex flex-wrap gap-x-6 gap-y-2 text-sm font-medium text-stone-600"
                >
                    <Link
                        :href="adminProductsIndex()"
                        class="hover:text-amber-900"
                    >
                        Products
                    </Link>
                    <Link
                        :href="adminCategoriesIndex()"
                        class="hover:text-amber-900"
                    >
                        Categories
                    </Link>
                    <Link :href="productsIndex()" class="hover:text-amber-900">
                        View shop
                    </Link>
                </nav>
            </div>
        </header>

        <div class="relative z-10">
            <slot />
        </div>
    </div>
</template>
