<template>
  <div>
    <div v-if="error" class="error-box-wrap">
      <error-box>
        <p>
          データ取得時にエラーが発生しました。時間をおいた後、ログインし直してから再度お試しください。
        </p>
      </error-box>
    </div>
    <div class="video-wrap">
      <div v-if="isAuth0Provider && !auth0User.email_verified">
        <verification-email-box />
      </div>
      <div v-if="!isAuth0Provider || auth0User.email_verified" class="video">
        <iframe
          v-if="lecture.video_url"
          :src="`${lecture.video_url}?autoplay=1&color=26a69a`"
          frameborder="0"
          allow="autoplay; fullscreen"
          allowfullscreen
          style="
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
          "
          @load="createLearningHistory()"
        />
      </div>
      <div v-if="auth0User.email_verified" class="video-btns">
        <div v-if="lecture.prev_lecture_slug" class="video-btn video-btn-prev">
          <nuxt-link
            :to="`/course/${this.$route.params.name}/lecture/${lecture.prev_lecture_slug}`"
            class="video-btn-link"
          >
            <i class="fas fa-less-than" />
          </nuxt-link>
        </div>
        <div v-if="lecture.next_lecture_slug" class="video-btn video-btn-next">
          <nuxt-link
            :to="`/course/${this.$route.params.name}/lecture/${lecture.next_lecture_slug}`"
            class="video-btn-link"
          >
            <i class="fas fa-greater-than" />
          </nuxt-link>
        </div>
      </div>
      <div v-if="loading" class="loading">
        <i class="fad fa-spinner fa-spin fa-lg" />
      </div>
    </div>

    <div class="detail">
      <div class="detail-btns">
        <nuxt-link
          v-if="lecture.prev_lecture_slug"
          :to="`/course/${this.$route.params.name}/lecture/${lecture.prev_lecture_slug}`"
          class="detail-btn-link detail-btn-prev"
        >
          <i class="fas fa-less-than" />
        </nuxt-link>
        <nuxt-link
          v-if="lecture.next_lecture_slug"
          :to="`/course/${this.$route.params.name}/lecture/${lecture.next_lecture_slug}`"
          class="detail-btn-link"
        >
          <i class="fas fa-greater-than" />
        </nuxt-link>
      </div>
      <div class="detail-content">
        <h3 class="detail-header">
          このレクチャーの内容・補足
        </h3>
        <div class="detail-body">
          <!-- eslint-disable vue/no-v-html -->
          <div v-if="lecture.description" v-html="lectureDescription" />
          <!-- eslint-enable vue/no-v-html -->
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.video {
  padding: 56.25% 0 0 0;
  position: relative;
}

.video-btns {
  display: none;
}

@media screen and (min-width: 769px) {
  .video-btns {
    display: block;
    opacity: 0;
    transition: opacity 0.3s ease 0s;
  }
}

.video-btn {
  background-color: $color-teal2;
  display: flex;
  height: 64px;
  position: absolute;
  top: calc(50% - 32px);
}

.video-btn-prev {
  margin-right: 0.5rem;
}

.video-btn-next {
  margin-left: 0.5rem;
  right: 0;
}

.video-btn-link {
  align-items: center;
  display: flex;
  padding-left: 1.8rem;
  padding-right: 1.8rem;

  i {
    color: $color-white1;
  }
}

.video-wrap {
  border-radius: 0.5rem 0.5rem 0 0;
  overflow: hidden;
  position: relative;

  &:hover {
    .video-btns {
      opacity: 1;
    }
  }
}

.detail {
  padding: 2rem 2rem;
}

@media screen and (min-width: 769px) {
  .detail {
    padding: 4.2rem 5.6rem;
  }
}

.detail-content {
  margin-bottom: 2.8rem;
}

@media screen and (min-width: 769px) {
  .detail-content {
    margin-bottom: 3.2rem;
  }
}

.detail-btns {
  display: flex;
  margin-bottom: 2.8rem;
}

@media screen and (min-width: 769px) {
  .detail-btns {
    display: none;
  }
}

.detail-btn-link {
  align-items: center;
  background-color: $color-gray1;
  border-radius: 0.8rem;
  color: $color-gray3;
  display: flex;
  flex: 1 1 0%;
  height: 5rem;
  justify-content: center;
  transition: background-color 0.3s, border 0.3s;
}

.detail-btn-prev {
  margin-right: 1rem;
}

.detail-header {
  background-color: $color-white2;
  border-radius: 0.8rem;
  font-weight: 700;
  margin-bottom: 2rem;
  padding: 1.6rem 1.4rem;
}

@media screen and (min-width: 769px) {
  .detail-header {
    margin-bottom: 2.4rem;
    padding: 2rem 1.6rem;
  }
}

@media screen and (min-width: 769px) {
  .detail-body {
    margin: 0 1.6rem;
  }
}

.loading {
  align-items: center;
  color: $color-teal1;
  display: flex;
  justify-content: center;
  left: 47%;
  position: absolute;
  top: 50%;
}

.error-box-wrap {
  margin: 4rem;
}
</style>

<style lang="scss">
.detail-body {
  h4 {
    margin-bottom: 3rem;
  }

  p {
    margin-bottom: 3rem;
  }

  a {
    color: $color-blue;
  }

  ol,
  ul {
    padding: 0 0 3rem 2rem;
  }

  ul {
    list-style: disc;
  }

  li {
    padding: 0.6rem 0;
  }

  ol {
    counter-reset: count;
    list-style: decimal;
  }

  ol > li {
    &:before {
      counter-increment: count;
    }
  }
}
</style>

<script>
import ErrorBox from '@/components/commons/ErrorBox.vue'
import VerificationEmailBox from '@/components/partials/course/VerificationEmailBox.vue'
import { mapState, mapGetters } from 'vuex'

export default {
  layout: 'course',
  components: {
    ErrorBox,
    VerificationEmailBox,
  },
  data() {
    return {
      lecture: {},
      loading: true,
      error: null,
    }
  },
  computed: {
    ...mapState(['title']),
    ...mapState('auth0', ['auth0User']),
    ...mapState('course', ['course', 'parts', 'lessons', 'lectures']),
    ...mapGetters('auth0', ['isAuth0Provider']),
    lectureDescription() {
      return this.$md.render(this.lecture.description)
    },
  },
  async created() {
    this.$store.dispatch('course/setLecture', {})
    this.$store.dispatch('setTitle', '')
    this.$store.dispatch('course/setCourseTop', false)
    const token = await this.$auth0.getTokenSilently()
    const options = {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    }

    // レクチャーを取得
    this.$axios
      .$get(`/lectures/${this.$route.params.slug}`, options)
      .then((res) => {
        this.loading = false
        this.lecture = res
        this.$store.dispatch('course/setLecture', res)
        this.$store.dispatch('setTitle', res.name)
      })
      .catch((err) => {
        this.loading = false
        this.error = err
        this.$sentry.captureException(err)
      })

    // コース関連のデータを取得
    const isEmpty = (obj) => !Object.keys(obj).length
    if ([this.course, this.parts, this.lessons, this.lectures].some(isEmpty)) {
      Promise.all([
        this.$axios.$get(`/courses/${this.$route.params.name}`, options),
        this.$axios.$get(`/parts?course=${this.$route.params.name}`, options),
        this.$axios.$get(`/lessons?course=${this.$route.params.name}`, options),
        this.$axios.$get(
          `/lectures?course=${this.$route.params.name}`,
          options
        ),
      ])
        .then((res) => {
          // TODO: lectureが別のコースのデータの場合、404かTOPにリダイレクトさせる
          this.loading = false
          this.$store.dispatch('course/setCourse', res[0])
          this.$store.dispatch('course/setParts', res[1])
          this.$store.dispatch('course/setLessons', res[2])
          this.$store.dispatch('course/setLectures', res[3])
        })
        .catch((err) => {
          this.loading = false
          this.error = err
          this.$sentry.captureException(err)
        })
    }

    // 受講履歴を取得
    this.$axios
      .$get(
        `/learning_histories/${this.$route.params.name}/lecture_ids`,
        options
      )
      .then((res) => {
        this.$store.dispatch('course/setLearnedLectureIds', res)
      })
      .catch((err) => {
        this.loading = false
        this.error = err
        this.$sentry.captureException(err)
      })
  },
  mounted() {
    // eslint-disable-next-line no-undef
    Prism.highlightAll()
  },
  methods: {
    async createLearningHistory() {
      if (this.lecture.learned) {
        return
      }
      const token = await this.$auth0.getTokenSilently()
      const options = {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
      await this.$axios
        .$post(
          'learning_histories',
          { course_id: this.lecture.course_id, lecture_id: this.lecture.id },
          options
        )
        .catch((err) => {
          this.$sentry.captureException(err)
        })
    },
  },
  head() {
    return {
      title: `独学エンジニア - ${this.title}`,
      titleTemplate: '',
    }
  },
}
</script>
