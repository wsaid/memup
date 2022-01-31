<template>
  <div>
    <Head :title="form.name" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/questions">Questions</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
    </h1>
    <trashed-message v-if="question.deleted_at" class="mb-6" @restore="restore"> This question has been deleted. </trashed-message>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-area v-model="form.question_text" :error="form.errors.question_text" class="pb-8 pr-6 w-full" label="Question" />
          <select-input v-model="question.subject.id" @change="getTopics($event.target.value)" :error="form.errors.country" class="pb-8 pr-6 w-full lg:w-1/2" label="Subject">
              <option v-for="subject in subjects.data" v-bind:key="subject.value" :value="subject.id">
                {{ subject.name }}
              </option>
          </select-input>

          <select-input v-model="question.topic.id" :error="form.errors.country" class="pb-8 pr-6 w-full lg:w-1/2" label="Topic">
              <option v-for="topic in topics.data" v-bind:key="topic.value" :value="topic.id">
                {{ topic.name }}
              </option>
          </select-input>
          
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button v-if="!question.deleted_at" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">Delete Question</button>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Update Question</loading-button>
        </div>
      </form>
    </div>
    <h2 class="mt-12 text-2xl font-bold">Choices</h2>
    <div class="mt-6 bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Name</th>
          <th class="pb-4 pt-6 px-6">City</th>
          <th class="pb-4 pt-6 px-6" colspan="2">Phone</th>
        </tr>
        <tr v-for="choice in question.choices" :key="choice.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/choices/${choice.id}/edit`">
              {{ choice.text }}
              <icon v-if="choice.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/choices/${choice.id}/edit`" tabindex="-1">
              {{ choice.is_correct }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/choices/${choice.id}/edit`" tabindex="-1">
              {{ choice.phone }}
            </Link>
          </td>
          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/choices/${choice.id}/edit`" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>
        <tr v-if="question.choices.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No choices found.</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import TextArea from '@/Shared/TextareaInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    Head,
    Icon,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TextArea,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    question: Object,
    topics: Object,
    subjects: Object
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        question_text: this.question.text,
        // subject_id: this.question.subject_id,
        // topic_id: this.question.topic_id,
        topics: this.topics,
        subjects: this.subjects
      }),
    }
  },
  methods: {
    update() {
      this.form.put(`/questions/${this.question.id}`)
    },
    destroy() {
      if (confirm('Are you sure you want to delete this question?')) {
        this.$inertia.delete(`/questions/${this.question.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this question?')) {
        this.$inertia.put(`/questions/${this.question.id}/restore`)
      }
    },
    getTopics(subject_id) {
      this.$inertia.get(`/subject/${subject_id}/topics`)
    }
  },
}
</script>
