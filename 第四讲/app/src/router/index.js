import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import News from '@/components/News'
import Home from '@/components/Home'
import Users from '@/components/User'
import UserDetail from '@/components/UserDetail'
import Elements from '@/components/Elements'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path     : '/home',
      name     : 'Home',
      component: Home
    }, {
      path     : '/news',
      name     : 'News',
      component: News
    }, {
      path     : '/user',
      name     : 'User',
      component: Users,
      children : [
        {
          path     : 'name/:name/age/:age',  //第一个参数名字前面不要加上/
          component: UserDetail
        }
      ]
    }, {
      path     : '/element',
      name     : 'Element',
      component: Elements,
    },
  ]
})
