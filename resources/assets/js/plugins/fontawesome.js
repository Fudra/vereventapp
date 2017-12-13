import Vue from 'vue'
import fontawesome from '@fortawesome/fontawesome'
import FontAwesomeIcon from '@fortawesome/vue-fontawesome'

Vue.component('fa', FontAwesomeIcon)

// import { } from '@fortawesome/fontawesome-free-regular'

import solid from '@fortawesome/fontawesome-free-solid'

// import { faGithub } from '@fortawesome/fontawesome-free-brands'

fontawesome.library.add(
  solid
)
