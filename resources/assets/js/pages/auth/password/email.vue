<template>
  <section class="section">
    <div class="container is-fluid">
      <div class="columns">
        <div class="column is-half is-offset-one-quarter">
          <h1 class="title">{{$t('reset_password')}}</h1>
          <form @submit.prevent="send" @keydown="form.onKeydown($event)" class="form">
            <alert-success :form="form" :message="status"></alert-success>

            <!-- Email -->
            <div class="field">
              <label class="label" for="email">{{ $t('email') }}</label>
              <p class="control">
                <input v-model="form.email" type="email" name="email" class="input" id="email"
                       :class="{ 'is-danger': form.errors.has('email') }">
                <has-error :form="form" field="email"></has-error>
              </p>
            </div>

            <div class="field">
              <p class="control">
                <button class="button is-primary" :class="{'is-loading': form.busy }">
                  {{ $t('send_password_reset_link') }}
                </button>
              </p>
            </div>

          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import Form from 'vform'

export default {
  metaInfo () {
    return { title: this.$t('reset_password') }
  },

  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),

  methods: {
    async send () {
      const { data } = await this.form.post('/api/password/email')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
