<template>
    <Head title="Laporan" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Laporan
            </h2>
        </template>

        <div class="py-12">
            <div class="container mx-auto sm:px-6 lg:px-8">

                <div class="
                        overflow-hidden
                        bg-white
                        shadow-sm
                        max-w-7xl
                        sm:rounded-lg
                    ">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="/generate-pdf" class="btn btn-primary px-6 py-2 text-white bg-gray-900 rounded" target="_blank">CETAK PDF</a>
                        <div class="mt-2">
                            Saldo: {{ saldo }}
                        </div>
                        <div class="mt-2">
                            Total Masuk: {{ total_masuk }}
                        </div>
                        <div class="mt-2">
                            Total Keluar: {{ total_keluar }}
                        </div>
                        <table style="width: 100%; display: table; table-layout: fixed;">
                            <thead class="font-bold bg-gray-300 border-b-2">
                                <td class="px-4 py-2">Transaksi</td>
                                <td class="px-4 py-2">Tanggal Transaksi</td>
                                <td class="px-4 py-2">Nominal Transaksi</td>
                                <td class="px-4 py-2">Deskripsi</td>
                            </thead>
                            <tbody>
                                <tr v-for="transaksi in transaksis.data" :key="transaksi.id">
                                    <td class="px-4 py-2">
                                        <div v-if="transaksi.jenis_transaksi == 'k'" class="px-4 py-2 text-red-600">Keluar</div>
                                        <div v-else class="px-4 py-2 text-green-600">Masuk</div>
                                    </td>
                                    <td class="px-4 py-2">{{ transaksi.tanggal_transaksi }}</td>
                                    <td class="px-4 py-2">
                                        <div v-if="transaksi.jenis_transaksi == 'k'" class="px-4 py-2 text-red-600">- {{ transaksi.nominal_transaksi }}</div>
                                        <div v-else class="px-4 py-2 text-green-600">+ {{ transaksi.nominal_transaksi }}</div>
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ transaksi.deskripsi }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination :links="transaksis.links" />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeNavLink,
        Pagination,
        Link,
    },
    props: {
        transaksis: Object,
        total_masuk: Object,
        total_keluar: Object,
        saldo: Object,
    },
    methods:{
    },
};
</script>