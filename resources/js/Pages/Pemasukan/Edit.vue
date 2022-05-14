<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Edit Pengeluaran
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <input
                                    name="user_id"
                                    type="hidden"
                                    v-model="form.user_id"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                />
                            </div>
                            <div>
                                <label for="title">Nominal Keluar</label>
                                <input
                                    name="nominal_transaksi"
                                    type="number"
                                    v-model="form.nominal_transaksi"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                />
                            </div>
                            <div v-if="errors.nominal_transaksi" class="text-red-600">
                                {{ errors.nominal_transaksi }}
                            </div>
                            <div>
                                <label for="title">Tanggal Keluar</label>
                                <input
                                    name="tanggal_transaksi"
                                    type="date"
                                    v-model="form.tanggal_transaksi"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                />
                            </div>
                            <div v-if="errors.tanggal_transaksi" class="text-red-600">
                                {{ errors.tanggal_transaksi }}
                            </div>
                            <div class="mt-4">
                                <label for="title">Deskripsi</label>
                                <textarea
                                    name="deskripsi"
                                    type="text"
                                    v-model="form.deskripsi"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                >
                                </textarea>
                            </div>
                            <div v-if="errors.deskripsi" class="text-red-600">
                                {{ errors.deskripsi }}
                            </div>

                            <!-- submit -->
                            <div class="py-4">
                                <button
                                    :disabled="form.processing"
                                    class="
                                        px-6
                                        py-2
                                        text-white
                                        bg-gray-900
                                        rounded
                                    "
                                >
                                    Save
                                </button>
                                <Link class="px-6
                                        py-2
                                        text-gray-900
                                        bg-white
                                        rounded
                                        ml-2" :href="route('pemasukans.index')">
                                Cancel
                                </Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
    },
    setup(props) {
        const form = useForm({
            user_id: props.user.id,
            nominal_transaksi: props.pemasukan.nominal_transaksi,
            tanggal_transaksi: props.pemasukan.tanggal_transaksi,
            deskripsi: props.pemasukan.deskripsi,
            

        });

        return { form };
    },
    methods: {
        submit() {
            this.form.put(route("pemasukans.update", this.pemasukan.id));
        },
    },
    props: {
        user: Object,
        pemasukan: Object,
        errors: Object
    },
};
</script>