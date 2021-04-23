<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contacts / <span class="text-indigo-700">Create</span>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <div class="grid grid-cols-2 gap-6">
                                <div class="col-span-2 md:col-span-1">
                                    <jet-label
                                        for="first_name"
                                        value="First Name"
                                    />
                                    <jet-input
                                        id="first_name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.first_name"
                                    />
                                    <jet-input-error
                                        :message="form.errors.first_name"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <jet-label
                                        for="last_name"
                                        value="Last Name"
                                    />
                                    <jet-input
                                        id="last_name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.last_name"
                                    />
                                    <jet-input-error
                                        :message="form.errors.last_name"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <jet-label for="phone" value="Phone" />
                                    <jet-input
                                        id="phone"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.phone"
                                    />
                                    <jet-input-error
                                        :message="form.errors.phone"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <jet-label for="email" value="Email" />
                                    <jet-input
                                        id="email"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.email"
                                    />
                                    <jet-input-error
                                        :message="form.errors.email"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <jet-label for="address" value="Address" />
                                    <t-textarea v-model="form.address" />
                                    <jet-input-error
                                        :message="form.errors.address"
                                        class="mt-2"
                                    />
                                </div>
                                <div class="col-span-2 md:col-span-1">
                                    <input
                                        type="file"
                                        class="hidden"
                                        ref="photo"
                                        @change="updatePhotoPreview"
                                    />
                                    <jet-label for="photo" value="Photo" />
                                    <div class="md:flex items-center">
                                        <div class="mt-2" v-show="photoPreview">
                                            <span
                                                class="block rounded-full w-20 h-20"
                                                :style="
                                                    'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                                                    photoPreview +
                                                    '\');'
                                                "
                                            >
                                            </span>
                                        </div>
                                        <jet-secondary-button
                                            class="mt-2"
                                            :class="{ 'md:ml-2': photoPreview }"
                                            type="button"
                                            @click.prevent="selectNewPhoto"
                                        >
                                            Select A New Photo
                                        </jet-secondary-button>
                                    </div>

                                    <jet-input-error
                                        :message="form.errors.photo"
                                        class="mt-2"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <jet-button> Save </jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import TTextarea from "@/TailwindComponents/Textarea";

export default {
    components: {
        AppLayout,
        JetInput,
        JetInputError,
        JetLabel,
        JetButton,
        JetSecondaryButton,
        TTextarea,
    },
    data() {
        return {
            form: this.$inertia.form({
                first_name: null,
                last_name: null,
                email: null,
                phone: null,
                address: null,
                photo: null,
            }),
            photoPreview: null,
        };
    },
    methods: {
        selectNewPhoto() {
            this.$refs.photo.click();
        },
        updatePhotoPreview() {
            const reader = new FileReader();

            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.photo.files[0]);
        },
        submit() {
            if (this.$refs.photo) {
                this.form.photo = this.$refs.photo.files[0];
            }

            this.form.post(route("contacts.store"), {
                errorBag: "submit",
                preserveScroll: true,
            });
        },
    },
};
</script>
