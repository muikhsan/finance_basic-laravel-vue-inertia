<template>
    <Head title="Pengeluaran" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Pengeluaran
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
                        <div class="mb-4">
                            <Link
                                class="
                                    px-4
                                    py-2
                                    mb-2
                                    text-red-100
                                    bg-red-500
                                    rounded
                                "
                                :href="route('pengeluarans.create')"
                            >
                                Tambah Pengeluaran
                            </Link>
                        </div>
                        <div class="mt-2">
                            Total Keluar: {{ total_keluar }}
                        </div>
                        <table style="width: 100%; display: table; table-layout: fixed;">
                            <thead class="font-bold bg-gray-300 border-b-2">
                                <td class="px-4 py-2">Transaksi</td>
                                <td class="px-4 py-2">Tanggal keluar</td>
                                <td class="px-4 py-2">Nominal keluar</td>
                                <td class="px-4 py-2">Deskripsi</td>
                                <td class="px-4 py-2">Action</td>
                            </thead>
                            <tbody>
                                <tr v-for="pengeluaran in pengeluarans.data" :key="pengeluaran.id">
                                    <td class="px-4 py-2">
                                        <div class="px-4 py-2 text-red-600" v-if="pengeluaran.jenis_transaksi == 'k'">Keluar</div>
                                        <div v-else class="px-4 py-2 text-green-600">Masuk</div>
                                    </td>
                                    <td class="px-4 py-2">{{ pengeluaran.tanggal_transaksi }}</td>
                                    <td class="px-4 py-2 text-red-600">- {{ pengeluaran.nominal_transaksi }}</td>
                                    <td class="px-4 py-2">
                                        {{ pengeluaran.deskripsi }}
                                    </td>
                                    <td class="px-4 py-2 font-extrabold">
                                        <Link
                                            class="text-green-700"
                                            :href="route('pengeluarans.edit', pengeluaran.id)"
                                        >
                                            Edit
                                        </Link>
                                        <Link
                                            
                                            @click="destroy(pengeluaran.id)"
                                            class="text-red-700 ml-2"
                                            >
                                            Delete
                                            </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination :links="pengeluarans.links" />
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
        pengeluarans: Object,
        total_keluar: Object,
    },
    methods: {
        destroy(id) {
            this.$inertia.delete(route("pengeluarans.destroy", id));
        },
    },
};
</script>