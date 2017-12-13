<template>
  <section class="section">
    <div class="container is-fluid">
      <div class="columns">
        <div class="column is-half is-offset-one-quarter">
          <h1 class="title">{{$t('reset_password')}}</h1>
          <form @submit.prevent="reset" @keydown="form.onKeydown($event)" class="form">
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

            <!-- Password -->
            <div class="field">
              <label class="label" for="password">{{ $t('password') }}</label>
              <p class="control">
                <input v-model="form.password" type="password" name="password" class="input"
                       id="password"
                       :class="{ 'is-danger': form.errors.has('password') }">
                <has-error :form="form" field="password"></has-error>
              </p>
            </div>


            <!-- Password Confirmation -->
            <div class="field">
              <label class="label" for="password_confirmation">{{ $t('confirm_password') }}</label>
              <p class="control">
                <input v-model="form.password_confirmation" type="password" name="password_confirmation" class="input"
                       id="password_confirmation"
                       :class="{ 'is-danger': form.errors.has('password_confirmation') }">
                <has-error :form="form" field="password"></has-error>
              </p>
            </div>


            <div class="field">
              <p class="control">
                <button class="button is-primary" :class="{'is-loading': form.busy }">
                  {{ $t('reset_password') }}
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
import AlertSuccess from '../../../components/layout/alert/Success';

export default {
	components: { AlertSuccess },
	metaInfo () {
    return { title: this.$t('reset_password') }
  },

  data: () => ({
    status: '',
    form: new Form({
      token: '',
      email: '',
      password: '',
      password_confirmation: ''
    })
  }),

  methods: {
    async reset () {
      this.form.token = this.$route.params.token

      const { data } = await this.form.post('/api/password/reset')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
