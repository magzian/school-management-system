<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import AdminLayout from "../Layouts/AdminLayout.vue";

defineProps({
    students: Array,
});

const errors = ref({});
const editMode = ref(false);
const fname = ref("");
const lname = ref("");
const email = ref("");
const gender = ref("");
const phone = ref("");
const address = ref("");
const reg_date = ref("");
const parent_number = ref("");
const parent_email = ref("");
const dob = ref("");
const blood_group = ref("");
const image_path = ref(null);
const id = ref(null);

const openAddModal = () => {
    resetForm();
    editMode.value = false;
    document.getElementById("studentModal").showModal();
};

const openEditModal = (student) => {
    editMode.value = true;
    id.value = student.id;
    fname.value = student.fname;
    lname.value = student.lname;
    email.value = student.email;
    gender.value = student.gender;
    phone.value = student.phone;
    address.value = student.address;
    reg_date.value = student.reg_date;
    parent_number.value = student.parent_number;
    parent_email.value = student.parent_email;
    dob.value = student.dob;
    blood_group.value = student.blood_group;

    document.getElementById("studentModal").showModal();
};

const handleFileChange = (e) => {
    image_path.value = e.target.files[0];
};

const resetForm = () => {
    fname.value = "";
    lname.value = "";
    email.value = "";
    gender.value = "";
    phone.value = "";
    address.value = "";
    reg_date.value = "";
    parent_number.value = "";
    parent_email.value = "";
    dob.value = "";
    blood_group.value = "";
    image_path.value = null;
    id.value = null;
};

const addStudent = async () => {
    errors.value = {};
    const formData = new FormData();
    formData.append("fname", fname.value);
    formData.append("lname", lname.value);
    formData.append("email", email.value);
    formData.append("gender", gender.value);
    formData.append("phone", phone.value);
    formData.append("address", address.value);
    formData.append("reg_date", reg_date.value);
    formData.append("parent_number", parent_number.value);
    formData.append("parent_email", parent_email.value);
    formData.append("dob", dob.value);
    formData.append("blood_group", blood_group.value);
    if (image_path.value) {
        formData.append("image_path", image_path.value);
    }

    try {
        await router.post("/admin/students/store", formData, {
            onSuccess: (page) => {
                document.getElementById("studentModal").close();
                Swal.fire({
                    toast:true,
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    title: page.props.flash || "Student added successfully",
                });
                resetForm();
            },
            onError: (err) => {
                errors.value = err;
            }
        });
    } catch (e) {
        console.error(e);
    }
};

const updateStudent = async () => {
    errors.value = {};
    const formData = new FormData();
    formData.append("fname", fname.value);
    formData.append("lname", lname.value);
    formData.append("email", email.value);
    formData.append("gender", gender.value);
    formData.append("phone", phone.value);
    formData.append("address", address.value);
    formData.append("reg_date", reg_date.value);
    formData.append("parent_number", parent_number.value);
    formData.append("parent_email", parent_email.value);
    formData.append("dob", dob.value);
    formData.append("blood_group", blood_group.value);
    formData.append("_method", 'PUT');

    if (image_path.value) {
        formData.append("image_path", image_path.value);
    }

    try{
        await router.post("/admin/students/update/" + id.value, formData, {
            onSuccess: (page) => {
                document.getElementById("studentModal").close();
                Swal.fire({
                    toast:true,
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    title: page.props.flash || "Student updated successfully",
                });
                resetForm();
            },
            onError: (err) => {
                errors.value = err;
            }
        });
    } catch (error) {
        console.log(error);
    }

   
};

const confirmDelete = (student, index) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete("/admin/students/delete/" + student.id, {
                onSuccess: (page) => {
                    this.delete(student, index)
                    Swal.fire({
                        toast:true,
                        icon: "success",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        title: page.props.flash || "Student deleted successfully",
                    });
                },
            });
        }   
    });
};
</script>

<template>
    <AdminLayout>
        <div class="container mx-auto">
            <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <div
                            class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div class="w-full md:w-1/2">
                                <form class="flex items-center">
                                    <label for="simple-search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                fill="currentColor" viewbox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" id="simple-search"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                            placeholder="Search" required="" />
                                    </div>
                                </form>
                            </div>
                            <div
                                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                <button @click="openAddModal" type="button"
                                    class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Add Student
                                </button>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">
                                            First name
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Last name
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Gender
                                        </th>
                                        
                                        
        
                                        <th scope="col" class="px-4 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="student in students.data" :key="student.id"
                                        class="border-b dark:border-gray-700">
                                        <td class="px-4 py-3">
                                            {{ student.fname }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ student.lname }}
                                        </td>
                                        <td class="px-4 py-3">
                                            {{ student.gender }}
                                        </td>
                                        <td class="px-4 py-3 flex items-center justify-end space-x-2">
                                            <button
                                                type="button"
                                                @click="openEditModal(student)"
                                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                    <path fill-rule="evenodd"
                                                        d="M11.013 2.513a1.75 1.75 0 0 1 2.475 2.474L6.226 12.25a2.751 2.751 0 0 1-.892.596l-2.047.848a.75.75 0 0 1-.98-.98l.848-2.047a2.75 2.75 0 0 1 .596-.892l7.262-7.261Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <button
                                                type="button"
                                                @click="confirmDelete(student)"
                                                class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                                                    <path fill-rule="evenodd"
                                                        d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Add/Edit Student Modal -->

                        <dialog id="studentModal" class="modal">
                            <form method="dialog" class="modal-box">
                                <h3 class="font-bold text-lg mb-4">{{ editMode ? 'Edit' : 'Add' }}</h3>
                                <div v-if="Object.keys(errors).length" class="mb-4">
                                    <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded">
                                        <li v-for="(msg, key) in errors" :key="key">{{ msg }}</li>
                                    </ul>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <input v-model="fname" type="text" placeholder="First Name" class="input input-bordered" />
                                    <input v-model="lname" type="text" placeholder="Last Name" class="input input-bordered" />
                                    <input v-model="email" type="email" placeholder="Email" class="input input-bordered" />
                                    <input v-model="phone" type="text" placeholder="Phone" class="input input-bordered" />
                                    <input v-model="gender" type="text" placeholder="Gender" class="input input-bordered" />
                                    <input v-model="address" type="text" placeholder="Address" class="input input-bordered" />
                                    <input v-model="dob" type="date" placeholder="DOB" class="input input-bordered" />
                                    <input v-model="reg_date" type="date" placeholder="DOR" class="input input-bordered" />
                                    <input v-model="parent_email" type="email" placeholder="Parent Email" class="input input-bordered" />
                                    <input v-model="parent_number" type="text" placeholder="Parent Number" class="input input-bordered" />
                                    <input v-model="blood_group" type="text" placeholder="Blood Group" class="input input-bordered" />
                                    <input type="file" @change="handleFileChange" class="file-input file-input-bordered" />
                                </div>
                                <div class="modal-action">
                                    <button class="btn" @click="resetForm">Cancel</button>
                                    <button class="btn btn-primary" @click.prevent="editMode ? updateStudent() : addStudent()">
                                        {{ editMode ? 'Update' : 'Add' }}
                                    </button>
                                </div>
                                    <div>

                                </div>
                            </form>
                        </dialog>

                        <!--  End modal  -->

                        <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                            aria-label="Table navigation">
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                Showing
                                <span class="font-semibold text-gray-900 dark:text-white">{{ students.from }}</span>
                                to
                                <span class="font-semibold text-gray-900 dark:text-white">{{ students.to }}</span>
                                of
                                <span class="font-semibold text-gray-900 dark:text-white">{{ students.total }}</span>
                            </span>
                            <ul class="inline-flex items-stretch -space-x-px">
                                <li v-for="(link, i) in students.links" :key="i">
                                    <button
                                        v-if="link.url"
                                        :class="[
                                            'flex items-center justify-center text-sm py-2 px-3 leading-tight border',
                                            link.active
                                                ? 'z-10 text-primary-600 bg-primary-50 border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white'
                                                : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
                                            i === 0 ? 'rounded-l-lg' : '',
                                            i === students.links.length - 1 ? 'rounded-r-lg' : ''
                                        ]"
                                        @click="router.visit(link.url, { preserveScroll: true })"
                                        v-html="link.label"
                                    />
                                    <span v-else
                                        class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-400 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-600">
                                        <span v-html="link.label" />
                                    </span>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
        </div>
    </AdminLayout>
</template>
