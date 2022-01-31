<template>
  <div>
    <Head title="Dashboard" />
    <h1 class="mb-8 text-3xl font-bold">Dashboard</h1>
    <p class="mb-8 leading-normal">{{ questions.data.body }}</p>
    
    <fieldset>
      <div
        class="flex items-center mb-4"
        v-for="choice in questions.data.choices"
        v-bind:key="choice.id"
      >
        <input
          type="radio"
          name="choice"
          v-model="answer"
          :value="choice.id"
          class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300"
        />
        <label class="text-sm font-medium text-gray-900 ml-2 block">
          {{ choice.body }}
        </label>
      </div>
    </fieldset>
    You have selected : {{ answer }}
    <div class="flex py-4 bg-gray-100 border-t border-gray-100">
      <button :disabled="!answer" class="btn-sky" @click="checkAnswer">Check</button>
    </div>
  </div>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import Layout from "@/Shared/Frontend/Layout";

export default {
  components: {
    Head,
  },
  layout: Layout,
  props: {
    menuItems: Array,
    questions: Object,
  },
  data() {
    return {
      answer: false,
    };
  },
  methods: {
    checkAnswer() {
        this.$inertia.post(`/question/${this.questions.data.id}/answer/${this.answer}`)
    }
  }
};
</script>
