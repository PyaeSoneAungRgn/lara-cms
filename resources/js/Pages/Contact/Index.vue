<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contacts
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between space-x-2 items-end mb-2">
                    <jet-input
                        id="search"
                        type="text"
                        class="mt-1 block w-full md:w-64"
                        placeholder="Search . . ."
                        v-model="keyword"
                        ref="keyword"
                    />
                    <inertia-link :href="route('contacts.create')"
                        ><jet-button>Create</jet-button></inertia-link
                    >
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div
                                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                            >
                                <div
                                    class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                                >
                                    <table
                                        class="min-w-full divide-y divide-gray-200"
                                    >
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="md:w-1/4 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Name
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="md:w-1/4 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Phone
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="md:w-1/4 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                >
                                                    Email
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="relative px-6 py-3"
                                                >
                                                    <span class="sr-only"
                                                        >Edit</span
                                                    >
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="bg-white divide-y divide-gray-200"
                                        >
                                            <tr
                                                v-show="
                                                    contacts.data.length == 0
                                                "
                                            >
                                                <td
                                                    colspan="4"
                                                    class="py-3 text-center text-xl text-gray-400"
                                                >
                                                    Empty
                                                </td>
                                            </tr>
                                            <tr
                                                v-for="contact in contacts.data"
                                                :key="contact.id"
                                            >
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap"
                                                >
                                                    <div
                                                        class="flex items-center"
                                                    >
                                                        <div
                                                            class="flex-shrink-0 h-10 w-10"
                                                        >
                                                            <img
                                                                class="h-10 w-10 rounded-full"
                                                                :src="
                                                                    contact.photo_url
                                                                "
                                                                :alt="
                                                                    contact.last_name
                                                                "
                                                            />
                                                        </div>
                                                        <div class="ml-4">
                                                            <p
                                                                class="text-sm font-medium text-gray-900"
                                                            >
                                                                {{
                                                                    `${contact.first_name} ${contact.last_name}`
                                                                }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap"
                                                >
                                                    <p
                                                        class="text-sm text-gray-900"
                                                    >
                                                        {{ contact.phone }}
                                                    </p>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap"
                                                >
                                                    <p
                                                        class="text-sm text-gray-900"
                                                    >
                                                        {{ contact.email }}
                                                    </p>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                                >
                                                    <inertia-link
                                                        :href="
                                                            route(
                                                                'contacts.edit', contact.id
                                                            )
                                                        "
                                                        class="text-indigo-600 hover:text-indigo-900"
                                                        >Edit</inertia-link
                                                    >
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <t-pagination class="mt-6" :links="contacts.links" />
            </div>
        </div>
    </app-layout>
</template>

<script>
import throttle from "lodash/throttle";

import AppLayout from "@/Layouts/AppLayout";
import JetInput from "@/Jetstream/Input";
import JetButton from "@/Jetstream/Button";
import TPagination from "@/TailwindComponents/Pagination";

export default {
    props: {
        contacts: Object,
        search: String,
    },
    components: {
        AppLayout,
        JetInput,
        JetButton,
        TPagination,
    },
    data() {
        return {
            keyword: this.search,
        };
    },
    watch: {
        keyword: {
            handler: throttle(function () {
                this.$inertia.visit(
                    this.route("contacts", {
                        search: this.keyword,
                    }),
                    {
                        only: ["contacts", "search"],
                    }
                );
            }, 150),
        },
    },
    mounted() {
        this.$refs.keyword.focus();
    },
};
</script>
