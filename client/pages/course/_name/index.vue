<template>
  <div>
    <div class="header">
      <div v-if="isAuth0Provider && !auth0User.email_verified">
        <verification-email-box />
        <div v-if="auth0Error">
          <error-box>
            <p>認証用メール送信時にエラーが発生しました。時間をおいた後、ログインし直してから再度お試しください。</p>
          </error-box>
        </div>
      </div>
      <h3 class="header-title">カリキュラム</h3>
      <p class="header-text">{{ course.description }}</p>
    </div>
    <div class="main">
      <div v-if="error">
        <error-box>
          <p>データ取得時にエラーが発生しました。時間をおいた後、ログインし直してから再度お試しください。</p>
        </error-box>
      </div>
      <div v-if="loading" class="loading">
        <i class="fad fa-spinner fa-spin fa-lg"></i>
      </div>
      <div class="part" v-for="part in course.parts">
        <div class="part-inner">
          <h3 class="part-subtitle">PART {{ part.order }}</h3>
          <h2 class="part-title">{{ part.name }}</h2>
          <p class="part-content">{{ part.description }}</p>
          <div v-for="lesson in part.lessons">
            <LectureList :lessonLectures="lesson" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.header {
  background-color: #fafbfc;
  border-bottom: 1px solid $color-gray1;
  border-radius: 0.5rem;
  padding: 2rem 3rem;
}

@media screen and (min-width: 769px) {
  .header {
    padding: 2.8rem 5.6rem;
  }
}

.header-title {
  font-size: $font-size-xxxl;
  font-weight: 300;
  margin-bottom: 1.4rem;
}

.header-text {
  color: $color-gray3;
  font-size: $font-size-sm;
  max-width: 90rem;
}

.main {
  min-height: 30vh;
  padding: 3rem 3rem 0;
  position: relative;
}

@media screen and (min-width: 769px) {
  .main {
    padding: 4.2rem 5.6rem 0;
  }
}

.part {
  margin-bottom: 4.2rem;

  &:not(:last-child):after {
    content: "";
    border-bottom: 1px solid $color-gray1;
    display: block;
  }
}

.part-inner {
  margin-bottom: 3rem;
}

@media screen and (min-width: 769px) {
  .part-inner {
    margin-bottom: 4.2rem;
  }
}

.part-subtitle {
  color: $color-gray2;
  font-size: $font-size-sm;
  letter-spacing: 1.5px;
  margin-bottom: 0.7rem;
}

.part-title {
  color: $color-teal1;
  font-size: $font-size-lg;
  margin-bottom: 1.4rem;
}

.part-content {
  line-height: 2.8rem;
  margin-bottom: 1.4rem;
}

.loading {
  color: $color-teal1;
  left: 47%;
  position: absolute;
  top: 50%;
}
</style>

<script>
import ErrorBox from "@/components/commons/ErrorBox.vue"
import LectureList from "@/components/partials/course/LectureList.vue"
import VerificationEmailBox from "@/components/partials/course/VerificationEmailBox.vue"
import { mapState, mapGetters } from "vuex"

export default {
  layout: "course",
  components: {
    ErrorBox,
    LectureList,
    VerificationEmailBox
  },
  data() {
    return {
      loading: true,
      error: null,
      auth0Error: null
    }
  },
  computed: {
    ...mapState("course", ["course"]),
    ...mapState("auth0", ["auth0User"]),
    ...mapGetters("auth0", ["isAuth0Provider"])
  },
  async created() {
    this.$store.dispatch("course/setLectureName", { name: "ホーム" })
    const token = await this.$auth0.getTokenSilently()
    const options = {
      headers: {
        Authorization: `Bearer ${token}`
      }
    }
    await this.$axios
      .$get(`/courses/${this.$route.params.name}/lectures`, options)
      .then(res => {
        this.loading = false
        this.$store.dispatch("course/setCourse", {
          course: res,
          lecture: {}
        })
      })
      .catch(err => {
        this.loading = false
        this.error = err
        this.$sentry.captureException(err)
      })
  }
}
</script>
