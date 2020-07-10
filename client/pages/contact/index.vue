<template>
  <static-page>
    <h1>お問い合わせ</h1>
    <p class="about">
      独学エンジニアのお問合せフォームです。
      <br />
      ご不明点やご意見がございましたら、こちらよりご連絡ください。
    </p>
    <hr />

    <div class="supplement">
      <span>
        <strong>
          <span class="must-color">*</span>
          必須項目
        </strong>
      </span>
    </div>

    <nui-form>
      <form
        class="contact-form"
        action="https://docs.google.com/forms/u/0/d/e/1FAIpQLSd_Kr47TuYofBJKkoe4WKF5GaqBIiQ1Lbfpm6AtTNSbelDbbw/formResponse"
        method="POST"
        target="submitComplate"
      >
        <div class="form-group">
          <label for="">
            <div class="asterix">*</div>
            お問い合わせ内容
          </label>
          <div class="form-radio-list">
            <label>
              <input
                v-model.trim="$v.about.$model"
                type="radio"
                name="entry.748218942"
                value="サービス内容について"
                required
              />
              <span>サービス内容について</span>
            </label>
            <label>
              <input
                v-model.trim="$v.about.$model"
                type="radio"
                name="entry.748218942"
                value="レッスン内容について"
              />
              レッスン内容について
            </label>
            <label>
              <input
                v-model.trim="$v.about.$model"
                type="radio"
                name="entry.748218942"
                value="エラー・トラブルについて"
              />
              エラー・トラブルについて
            </label>
            <label>
              <input
                v-model.trim="$v.about.$model"
                type="radio"
                name="entry.748218942"
                value="その他"
              />
              その他
            </label>
          </div>
          <div v-if="$v.about.$dirty">
            <div v-if="!$v.about.required" class="error-text">
              お問い合わせ内容は必須です。
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="entry.2074169978">
            <div class="asterix">*</div>
            <span style="font-size: 1.6rem;">お名前</span>
          </label>
          <input
            v-model.trim="$v.name.$model"
            type="text"
            name="entry.2074169978"
            required
            @input="delayTouch($v.name)"
          />
          <div v-if="$v.name.$dirty">
            <div v-if="!$v.name.required" class="error-text">
              お名前は必須です。
            </div>
            <div v-if="!$v.name.maxLength" class="error-text">
              ユーザー名は50文字以下で入力してください。
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="entry.844108524">
            <div class="asterix">*</div>
            <span style="font-size: 1.6rem;">
              メールアドレス（ご登録されている方はご登録のメールアドレス）
            </span>
          </label>
          <input
            v-model.trim="$v.email.$model"
            type="email"
            name="entry.844108524"
            required
            @input="delayTouch($v.email)"
          />
          <div v-if="$v.email.$dirty">
            <div v-if="!$v.email.required" class="error-text">
              メールアドレスは必須です。
            </div>
            <div v-if="!$v.email.email" class="error-text">
              メールアドレスのフォーマットが不適切です。
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="entry.75968316">
            <div class="asterix">*</div>
            <span style="font-size: 1.6rem;">
              お問い合わせ内容（詳細）
            </span>
          </label>
          <textarea
            v-model.trim="$v.detail.$model"
            class="form-textarea"
            name="entry.75968316"
            required
            rows="10"
          />
          <div v-if="$v.detail.$dirty">
            <div v-if="!$v.detail.required" class="error-text">
              お問い合わせ内容（詳細）は必須です。
            </div>
            <div v-if="!$v.detail.maxLength" class="error-text">
              お問い合わせ内容（詳細）は10,000文字以下で入力してください。
            </div>
          </div>
        </div>

        <div class="consent">
          プライバシーポリシーに同意して送信する
        </div>
        <div class="contact-btn">
          <nui-button
            class="btn-red1"
            :submit="true"
            :disabled="$v.$invalid || submitStatus === 'PENDING'"
            @click.native="submit"
          >
            送信する
          </nui-button>
        </div>
      </form>
    </nui-form>
    <iframe name="submitComplate" style="display: none;" />
  </static-page>
</template>

<style lang="scss" scoped>
.about {
  font-size: $font-size-sm;
  text-align: left;
}

hr {
  border: 0;
  border-bottom: 0.1rem solid $color-gray1;
  margin: 2rem 0 4rem;
}

@media screen and (min-width: 769px) {
  hr {
    border-bottom: 0.1rem solid $color-white1;
    border-top: 0.1rem solid $color-gray1;
  }
}

.supplement {
  font-size: $font-size-xs;
  margin-bottom: 2.4rem;
}

.must-color {
  color: $color-red1;
}

.contact-form {
  label {
    display: block;
  }

  input,
  textarea {
    background-color: $color-white1;
  }
}

.consent {
  font-size: $font-size-xs;
  margin-bottom: 2rem;
  text-align: center;
}

.contact-btn {
  text-align: center;
}
</style>

<script>
import StaticPage from '@/components/partials/static/StaticPage.vue'
import NuiButton from '@/components/commons/Button.vue'
import NuiForm from '@/components/commons/Form.vue'
import { required, maxLength, email } from 'vuelidate/lib/validators'

const touchMap = new WeakMap()

export default {
  components: {
    StaticPage,
    NuiButton,
    NuiForm,
  },
  data() {
    return {
      about: '',
      name: '',
      email: '',
      detail: '',
      submitStatus: null,
    }
  },
  beforeCreate() {
    this.$store.dispatch('setTitle', 'お問い合わせ')
  },
  validations: {
    about: {
      required,
    },
    name: {
      required,
      maxLength: maxLength(50),
    },
    email: {
      required,
      email,
    },
    detail: {
      required,
      maxLength: maxLength(10000),
    },
  },
  methods: {
    delayTouch($v) {
      $v.$reset()
      if (touchMap.has($v)) {
        clearTimeout(touchMap.get($v))
      }
      touchMap.set($v, setTimeout($v.$touch, 1000))
    },
    submit() {
      this.submitStatus = 'PENDING'
      this.$toast.global.instant_success({
        message: 'お問い合わせを受け付けました',
      })
      setTimeout(this.redirectTop, 1000)
    },
    redirectTop() {
      this.$router.push('/')
    },
  },
}
</script>
