<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 sm:px-12">
                        <div class="text-2xl">Welcome!</div>

                        <div class="mt-6 text-gray-700">
                            A demo application made with Laravel Jetstream
                            (Inertia + Vue).
                        </div>

                        <div class="mt-6 text-gray-700">
                            Database is reset every 30 minutes.
                            <!-- Only for my server -->
                        </div>

                        <div class="mt-6 text-gray-700">
                            Source Code is available at
                            <a
                                class="text-indigo-700"
                                href="https://github.com/PyaeSoneAungRgn/lara-cms"
                                >PyaeSoneAungRgn/lara-cms</a
                            >.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    components: {
        AppLayout,
    },
};
</script>
