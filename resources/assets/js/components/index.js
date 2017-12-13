import Vue from 'vue'
import { HasError, AlertWarning, AlertSuccess, AlertErrors, AlertError } from './global/alert'

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component(AlertWarning.name, AlertWarning)
Vue.component(AlertSuccess.name, AlertSuccess)
Vue.component(AlertErrors.name, AlertErrors)

// Load global components dynamically
const requireContext = require.context('./global', false, /.*\.(js|vue)$/)
requireContext.keys().forEach(file => {
  const Component = requireContext(file)

  if (Component.name) {
    Vue.component(Component.name, Component)
  }
})
