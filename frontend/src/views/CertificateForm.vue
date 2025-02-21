<template>
  <div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white shadow-lg rounded-lg">
      <h2 class="text-xl font-bold text-center text-gray-800 mb-6">Generate Certificate</h2>

      <form
        @submit.prevent="generateCertificate"
        class="space-y-4"
        style="width: 40%; align-content: center"
      >
        <div>
          <label class="block text-gray-700 text-sm">Date</label><br />
          <input v-model="form.date" type="date" class="form-input" required />
        </div>

        <div>
          <label class="block text-gray-700 text-sm">Image URL</label><br />
          <input v-model="form.image" type="url" class="form-input" required />
        </div>

        <div>
          <label class="block text-gray-700 text-sm">Signature Name</label>
          <input v-model="form.signature_name" type="text" class="form-input" required />
        </div>

        <div>
          <label class="block text-gray-700 text-sm">Student Name</label>
          <input v-model="form.student_name" type="text" class="form-input" required />
        </div>

        <div>
          <label class="block text-gray-700 text-sm">Subject</label>
          <input v-model="form.subject" type="text" class="form-input" required />
        </div>

        <button
          type="submit"
          class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition"
        >
          Generate Certificate
        </button>
      </form>

      <div v-if="downloadLink" class="mt-6 p-4 bg-green-100 text-green-700 rounded-lg text-center">
        <p class="font-semibold">Certificate Generated!</p>
        <a :href="downloadLink" target="_blank" class="text-blue-600 font-medium underline">
          Download Certificate
        </a>
      </div>
    </div>
  </div>
</template>
  
  <script>
import axios from 'axios'

export default {
  data() {
    return {
      form: {
        date: '',
        image:
          'https://png.pngtree.com/png-clipart/20230423/original/pngtree-travel-logo-design-template-for-business-and-company-png-image_9077410.png',
        signature_name: '',
        student_name: '',
        subject: '',
      },
      downloadLink: null,
    }
  },
  methods: {
    async generateCertificate() {
      try {
        const response = await axios.post(
          'http://127.0.0.1:8000/api/generate-certificate',
          this.form
        )
        this.downloadLink = response.data.response
      } catch (error) {
        console.error('Error generating certificate:', error)
        alert('Failed to generate certificate. Check console for details.')
      }
    },
  },
}
</script>
  
  <style scoped>
.form-input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 8px;
  margin-top: 4px;
  outline: none;
  transition: border 0.3s ease-in-out;
}

.form-input:focus {
  border-color: #3b82f6;
}
</style>
  