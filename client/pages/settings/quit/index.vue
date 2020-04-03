<template>
  <div class="container">
    <div class="heading">
      <h1 class="heading-title">アカウント削除</h1>
    </div>
    <main class="main">
      <div v-if="isAuth0Provider && !auth0User.email_verified" class="setting-form">
        <verification-email-box />
      </div>

      <div v-else>
        <nui-form>
          <form class="setting-form">
            <ul v-if="Object.keys(errors).length > 0" class="error-box">
              <li v-for="(value, key) in errors" :key="key" class="error-box-disc">{{ value[0] }}</li>
            </ul>

            <error-box>
              <p>アカウント削除は即時反映され、一度削除すると復活できません。これまでのデータはすべて削除されます。</p>
              <p>削除しますか？</p>
            </error-box>

            <div class="form-two-btns">
              <link-button to="/course/serverside" class="btn-outline-teal1">いいえ</link-button>
              <nui-button @click.native="deleteUser" class="btn-red1" :submit="true">はい</nui-button>
            </div>
          </form>
        </nui-form>
      </div>
    </main>
  </div>
</template>

<style lang="scss" scoped>
.heading {
  padding: 4rem 2.4rem;
}

@media screen and (min-width: 769px) {
  .heading {
    padding: 4rem;
  }
}

.heading-title {
  font-size: $font-size-xxxl;
  font-weight: 700;
}

.main {
  position: relative;
}

.setting-form {
  padding: 0 2.4rem 2.4rem;
}

@media screen and (min-width: 769px) {
  .setting-form {
    padding: 0 4rem 4rem;
  }
}
</style>

<script>
import NuiButton from "@/components/commons/Button.vue"
import NuiForm from "@/components/commons/Form.vue"
import ErrorBox from "@/components/commons/ErrorBox.vue"
import LinkButton from "@/components/commons/LinkButton.vue"
import VerificationEmailBox from "@/components/partials/course/VerificationEmailBox.vue"
import { mapState, mapGetters } from "vuex"

export default {
  layout: "logined",
  components: {
    NuiButton,
    NuiForm,
    ErrorBox,
    LinkButton,
    VerificationEmailBox
  },
  computed: {
    ...mapState("auth0", ["auth0User"]),
    ...mapGetters("auth0", ["userId", "isAuth0Provider"]),
    submitError() {
      return this.submitStatus === "ERROR"
    },
    submitPending() {
      return this.submitStatus === "PENDING"
    }
  },
  methods: {
    async deleteUser() {
      const options = await this.getOptions()
      await this.$axios
        .$delete(`/users/${this.userId}`, options)
        .then(res => {
          this.submitStatus = "OK"
          this.$toast.global.instant_success({
            message: "アカウントを削除しました"
          })
        })
        .catch(err => {
          this.submitStatus = "ERROR"
        })

      if (this.submitStatus != "OK") {
        return
      }

      await this.$auth0.logout({ returnTo: "/" })
    },
    async getOptions() {
      const token = await this.$auth0.getTokenSilently()
      return {
        headers: {
          Authorization: `Bearer ${token}`
        }
      }
    }
  }
}
</script>