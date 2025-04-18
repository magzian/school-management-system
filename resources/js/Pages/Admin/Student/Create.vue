<script setup>
import { ref } from 'vue';
import { router } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";

import AdminLayout from '../Layouts/AdminLayout.vue';
import Swal from 'sweetalert2';


// Student data

const id = ref("");
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
const loading = ref(false);

//Function to add image selection

const handleImageUpload = (e) => {
    image_path.value = e.target.files[0];
};

// Reset form data
const resetFormData = () => {
  fname.value = "";
  lname.value = "";
  gender.value = "";
  phone.value = "";
  address.value = "";
  reg_date.value = "";
  parent_number.value = "";
  parent_email.value = "";
  dob.value = "";
  blood_group.value = "";
  email.value = "";
  image_path.value = null;
};



//Add Student

const AddStudent = async () => {
    loading.value = true;

    const formData = new FormData();
    formData.append("fname", fname.value);
    formData.append("lname", lname.value);
    formData.append("gender", gender.value); 
    formData.append("phone", phone.value);
    formData.append("address", address.value);
    formData.append("reg_date", reg_date.value);
    formData.append("parent_number", parent_number.value);
    formData.append("parent_email", parent_email.value);
    formData.append("dob", dob.value);
    formData.append("blood_group", blood_group.value);
    formData.append("email", email.value); 
    
      // Append student image if selected
    if (image_path.value) {
    formData.append("image_path", image_path.value);
  }

    try {
        await router.post("/admin/students/store", formData, {
            onSuccess: (page) => {
                loading.value = false;
                Swal.fire({
                    toast:true,
                    icon:"success",
                    position:"top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    title: page.props.flash || "Student added successfully",
                });
                resetFormData()
            },
            onError: (errors) => {
                loading.value = false;
                Swal.fire({
                    icon:"error",
                    title: "Validation Error",
                    text: "Please check the form for errors",
                    showConfirmButton: "OK"
                });
                console.log(errors);
            },
            onFinish: () => {
                loading.value = false;
            }
        });
    } catch (error) {
        loading.value = false;
        Swal.fire({
            icon:"error",
            title: "Something went wrong",
            text: "Failed to add student. Please try again",
            showConfirmButton: "OK"
        });
        console.log(error);
    }
};



// Confirmation before submitting
const confirmAddStudent = () => {
  Swal.fire({
    title: 'Add New Student',
    text: 'Are you sure you want to add this student?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Yes, add student',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      AddStudent();
    }
  });
};



</script>

<template>
    <AdminLayout>
        <div class="container mx-auto">
      <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <form @submit.prevent="confirmAddStudent">
          <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
              <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First name</label>
              <input 
                type="text" 
                id="fname"
                v-model="fname"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="John" 
                required 
              />
            </div>
            <div>
              <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last name</label>
              <input 
                type="text" 
                id="lname"
                v-model="lname"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Doe" 
                required 
              />
            </div>
            <div>
              <label for="gender" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
              <select 
                id="gender"
                v-model="gender"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required
              >
                <option value="" disabled>Select gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div>
              <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone number</label>
              <input 
                type="tel" 
                id="phone"
                v-model="phone"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="123-45-678" 
              />
            </div>
            <div>
              <label for="parent_phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Parent phone number</label>
              <input 
                type="tel" 
                id="parent_phone"
                v-model="parent_number"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="123-45-678" 
                required 
              />
            </div>
            <div>
              <label for="parent_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Parent email</label>
              <input 
                type="email" 
                id="parent_email"
                v-model="parent_email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="parent@example.com" 
                required 
              />
            </div>
            <div>
              <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date of Birth</label>
              <input 
                id="dob" 
                type="date" 
                v-model="dob"
                class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                placeholder="Select dob"
                required
              />
            </div>
            <div>
              <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
              <input 
                type="text" 
                id="address"
                v-model="address"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required 
              />
            </div>
            <div>
              <label for="blood_group" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Blood Group</label>
              <select 
                id="blood_group"
                v-model="blood_group"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              >
                <option value="" disabled>Select blood group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
              </select>
            </div>
            <div>
              <label for="reg_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Registration Date</label>
              <input 
                id="reg_date" 
                type="date" 
                v-model="reg_date"
                class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
              />
            </div>
          </div>
          <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email address</label>
            <input 
              type="email" 
              id="email"
              v-model="email"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="john.doe@company.com" 
              required 
            />
          </div>
          <div class="mb-6">
            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student Image</label>
            <input 
              type="file" 
              id="image"
              @change="handleImageUpload"
              accept="image/*"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            />
          </div>
          <button 
            type="submit"
            
            :disabled="loading"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex items-center justify-center"
          >
            <svg v-if="loading" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ loading ? 'Adding...' : 'Add Student' }}
          </button>
        </form>
      </div>
    </div>
    </AdminLayout> 


</template>

