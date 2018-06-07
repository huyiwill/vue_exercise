import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import News from '@/components/News'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path     : '/hello',
      name     : 'HelloWorld',
      component: HelloWorld
    }, {
      path     : '/news',
      name     : 'News',
      component: News
    }
  ]
})
