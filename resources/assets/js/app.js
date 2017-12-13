import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import { i18n } from '~/plugins'
import App from '~/components/App'
import Buefy from 'buefy'
import 'buefy/lib/buefy.css'

import '~/components'

Vue.config.productionTip = false

Vue.use(Buefy)

new Vue({
  i18n,
  store,
  router,
  ...App
})
