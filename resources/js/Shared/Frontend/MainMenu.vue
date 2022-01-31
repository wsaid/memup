<template>
  <div>
    <nav class="sidebar">
      <!-- <div class="text">Side Menu</div> -->
      <ul>
        <li v-for="list in menuItems" :key="list.id">
          <a class="item" href="#"
            >{{ list.name }}
            <span v-if="list.topics" class="fas fa-caret-down"></span
          ></a>

          <ul v-if="list.topics">
            <li v-for="sub in list.topics" :key="sub.id">
              <Link :href="`/quiz/${sub.id}`">{{
                sub.name
              }}</Link>
            </li>
          </ul>
        </li>
      </ul>
    </nav>

     <!-- <div v-for="list in menuItems" :key="list.id" class="mb-4">
      <Link @click="showSubMenu = !showSubMenu" class="group flex items-center py-3" href="/">
        <icon name="dashboard" class="mr-2 w-4 h-4" :class="isUrl('') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">{{ list.name }}
            <span v-if="list.topics" class="fas fa-caret-down"></span>
        </div>
      </Link>
      <div v-for="sub in list.topics" :key="sub.id" class="mb-4" v-bind:class="{ 'hidden' : showSubMenu == false}">
         <Link class="group flex items-center py-3 px-4" href="/">
        <icon name="dashboard" class="mr-2 w-4 h-4" :class="isUrl('') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">{{ sub.name }}</div>
      </Link>
      </div>
    </div> -->
    
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Icon from "@/Shared/Icon";

export default {
  components: {
    Icon,
    Link,
  },
  props: {
    menuItems: Array,
  },
  data: function() {
    return {
      showSubMenu: false
    }
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1);
      if (urls[0] === "") {
        return currentUrl === "";
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length;
    },
  },
};
</script>
