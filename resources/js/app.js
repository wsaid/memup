import { createApp, h } from 'vue'
import { InertiaProgress } from '@inertiajs/progress'
import { createInertiaApp } from '@inertiajs/inertia-vue3'

InertiaProgress.init()

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  title: title => `${title} - MEM UP`,
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})


$(document).on('click', 'nav ul .item', function() {
  var el = $(this).next('ul');
  if (el.is(":visible")) {
    el.hide("fast");
  } else {
    el.show("fast");
  }
});

$(document).on('click', 'nav ul li', function() {
  $(this).addClass('active').siblings().removeClass('active');
});