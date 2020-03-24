<template>
  <div class="container">
    <div class="heading">
      <h1 class="heading-title">プロフィール</h1>
    </div>
    <main>
      <form class="profile-form">
        <ul v-if="Object.keys(errors).length > 0" class="error-box">
          <li v-for="(value, key) in errors" :key="key" class="error-box-disc">
            {{ value[0] }}
          </li>
        </ul>

        <div class="form-group">
          <label for="users[username]">ユーザー名</label>
          <input
            type="text"
            name="users[username]"
            required
          >
        </div>

        <div class="form-group">
          <label for="users[email]">メールアドレス</label>
          <input
            type="text"
            name="users[email]"
            required
          >
        </div>
      
        <div class="profile-form-btn">
          <nui-button class="btn-red1" :submit="true">
            変更する
          </nui-button>
        </div>
      </form>
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

.profile-form {
  padding: 0 2.4rem 2.4rem;
}

@media screen and (min-width: 769px) {
  .profile-form {
    padding: 0 4rem 4rem;
  }
}

.form-group {
  margin-bottom: 2.4rem;

  label {
    font-size: $font-size-sm;
    font-weight: 600;
  }

  input {
    border: 1px solid $color-gray1;
    border-radius: 0.4rem;
    color: $color-black;
    margin-top: .8rem;
    max-height: 3.2rem;
    padding: 2rem .8rem 2rem;
    width: 100%;
  }
}

.form-require {
  background: $color-red1;
  margin: 0 0 0 .8rem;
  padding: .2rem .4rem;
  border-radius: .2rem;
  color: #fff;
  font-size: $font-size-xs;
  vertical-align: top;
}

.error-box {
  background-color: $color-red3;
  border-radius: .4rem;
  color: $color-red1;
  font-size: $font-size-sm;
  font-weight: 700;
  margin-bottom: 3.5rem;
  padding: 1.5rem 3rem;
}

.error-box-disc {
  list-style-type: disc;
}

.error-text {
  color: $color-red1;
  font-size: $font-size-sm;
  margin-top: .8rem;
}

.profile-form-btn {
  margin-top: 3.2rem;

  .btn {
    width: 100%;
  }
}
</style>

<script>
import NuiButton from "@/components/commons/Button.vue"

export default {
  layout: "logined",
  components: {
    NuiButton,
  },
  beforeCreate() {
    this.$store.dispatch('setting/setTitle', { title: 'プロフィール' })
  }
}
</script>