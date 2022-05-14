<template>
    <Head title="Pemasukan" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Pemasukan
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
                                    text-green-100
                                    bg-green-500
                                    rounded
                                "
                                :href="route('pemasukans.create')"
                            >
                                Tambah Pemasukan
                            </Link>
                        </div>
                        <div class="mt-2">
                            Total Masuk: {{ total_masuk }}
                        </div>
                        <table style="width: 100%; display: table; table-layout: fixed;">
                            <thead class="font-bold bg-gray-300 border-b-2">
                                <td class="px-4 py-2">Transaksi</td>
                                <td class="px-4 py-2">Tanggal Masuk</td>
                                <td class="px-4 py-2">Nominal Masuk</td>
                                <td class="px-4 py-2">Deskripsi</td>
                                <td class="px-4 py-2">Action</td>
                            </thead>
                            <tbody>
                                <tr v-for="pemasukan in pemasukans.data" :key="pemasukan.id">
                                    <td class="px-4 py-2">
                                        <div v-if="pemasukan.jenis_transaksi == 'k'" class="px-4 py-2 text-red-600">Keluar</div>
                                        <div v-else class="px-4 py-2 text-green-600">Masuk</div>
                                    </td>
                                    <td class="px-4 py-2">{{ pemasukan.tanggal_transaksi }}</td>
                                    <td class="px-4 py-2 text-green-600">+ {{ pemasukan.nominal_transaksi    }}</td>
                                    <td class="px-4 py-2">
                                        {{ pemasukan.deskripsi }}
                                    </td>
                                    <td class="px-4 py-2 font-extrabold">
                                        <Link
                                            class="text-green-700"
                                            :href="route('pemasukans.edit', pemasukan.id)"
                                        >
                                            Edit
                                        </Link>
                                        <Link
                                            
                                            @click="destroy(pemasukan.id)"
                                            class="text-red-700 ml-2"
                                            >
                                            Delete
                                            </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <pagination :links="pemasukans.links" />
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
        pemasukans: Object,
        total_masuk: Object,
    },
    methods: {
        destroy(id) {
            this.$inertia.delete(route("pemasukans.destroy", id));
        },
    },
};
</script>