<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import BreezeNavLink from "@/Components/NavLink.vue";
    import {
        Head
    } from '@inertiajs/inertia-vue3';
    import {
        Link
    } from "@inertiajs/inertia-vue3";

</script>
<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>


        <div class="py-12">

            <div class="max-w-7xl max-h-fit mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-flow-row grid-flow-col gap-4">
                    <div
                        class="row-span-4 p-6 bg-white border-b border-gray-200 ml-2 text-lg text-gray-600 inline-block">
                        Saldo Total: {{ saldo }}
                    </div>
                    <div
                        class="row-span-2 col-span-2 p-6 bg-white border-b border-gray-200 ml-2 text-lg text-green-600 ">
                        Total Masuk: {{ total_pemasukan }}
                    </div>
                    <div class="row-span-2 col-span-2 p-6 bg-white border-b border-gray-200 ml-2 text-lg text-red-600">
                        Total Keluar: {{ total_pengeluaran }}
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
    export default {
        components: {
            BreezeAuthenticatedLayout,
            BreezeNavLink,
            Head,
            Link,
        },
        props: {
            total_pemasukan: Object,
            total_pengeluaran: Object,
            saldo: Object,
        },
    }

</script>
