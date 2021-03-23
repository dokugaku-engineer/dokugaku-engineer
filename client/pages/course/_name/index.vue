<template>
  <div>
    <div class="header">
      <div v-if="isAuth0Provider && !auth0User.email_verified">
        <verification-email-box />
        <div v-if="auth0Error">
          <error-box>
            <p>
              認証用メール送信時にエラーが発生しました。時間をおいた後、ログインし直してから再度お試しください。
            </p>
          </error-box>
        </div>
      </div>
      <h3 class="header-title">
        カリキュラム
      </h3>
      <p class="header-text">
        {{ course.description }}
      </p>
    </div>
    <div class="main">
      <div v-if="error">
        <error-box>
          <p>
            データ取得時にエラーが発生しました。時間をおいた後、ログインし直してから再度お試しください。
          </p>
        </error-box>
      </div>
      <div v-if="loading" class="loading">
        <i class="fad fa-spinner fa-spin fa-lg" />
      </div>
      <notification-box v-if="Object.keys(lastLecture()).length">
        <p class="header-text">
          ※現在講義はレッスン{{ lastLecture().lesson_id }}の{{
            lastLecture().order
          }}まで公開中です。それ以降は鋭意作成しております...！毎週火曜夜に公開しますので何卒お待ちください。
        </p>
      </notification-box>
      <div v-for="(part, index) in parts" :key="index" class="part">
        <div class="part-inner">
          <h3 class="part-subtitle">PART{{ part.order }}</h3>
          <h2 class="part-title">
            {{ part.name }}
          </h2>
          <p class="part-content">
            {{ part.description }}
          </p>
          <div v-for="(lesson, i) in filteredLessons(part.id)" :key="i">
            <lecture-list
              :course="course"
              :lesson="lesson"
              :lectures="filteredLectures(lesson.id)"
              :learned-lecture-ids="learnedLectureIds"
            />
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

  &:not(:last-child)::after {
    content: '';
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
import Meta from '@/assets/mixins/meta'
import ErrorBox from '@/components/commons/ErrorBox.vue'
import NotificationBox from '@/components/commons/NotificationBox.vue'
import LectureList from '@/components/partials/course/LectureList.vue'
import VerificationEmailBox from '@/components/partials/course/VerificationEmailBox.vue'
import { mapState, mapGetters } from 'vuex'

export default {
  layout: 'course',
  components: {
    ErrorBox,
    NotificationBox,
    LectureList,
    VerificationEmailBox,
  },
  mixins: [Meta],
  data() {
    return {
      loading: true,
      error: null,
      auth0Error: null,
      meta: {
        title: '独学エンジニア - ホーム',
        baseTitle: '',
      },
    }
  },
  computed: {
    ...mapState('auth0', ['auth0User']),
    ...mapState('course', ['course', 'parts', 'learnedLectureIds']),
    ...mapGetters('auth0', ['isAuth0Provider']),
    ...mapGetters('course', [
      'filteredLessons',
      'filteredLectures',
      'lastLecture',
    ]),
  },
  async created() {
    this.$store.dispatch('course/setLecture', {})
    this.$store.dispatch('setTitle', 'ホーム')
    this.$store.dispatch('course/setCourseTop', true)
    let options = await this.getOptions()
    await Promise.all([
      this.$axios.$get(`/courses/${this.$route.params.name}`, options),
      this.$axios.$get(`/parts?course=${this.$route.params.name}`, options),
      this.$axios.$get(`/lessons?course=${this.$route.params.name}`, options),
      this.$axios.$get(`/lectures?course=${this.$route.params.name}`, options),
      this.$axios.$get(
        `/learning_histories/${this.$route.params.name}/lecture_ids`,
        options
      ),
    ])
      .then((res) => {
        this.loading = false
        this.$store.dispatch('course/setCourse', res[0])
        this.$store.dispatch('course/setParts', res[1])
        this.$store.dispatch('course/setLessons', res[2])
        this.$store.dispatch('course/setLectures', res[3])
        this.$store.dispatch('course/setLearnedLectureIds', res[4])
      })
      .catch((err) => {
        this.loading = false
        this.error = err
        this.$sentry.captureException(err)
      })

    const sessionId = this.$route.query.session_id
    if (sessionId) {
      this.$axios
        .post(
          '/subscriptions',
          {
            session_id: sessionId,
          },
          options
        )
        .catch((err) => {
          this.$sentry.captureException(err)
        })
    }
  },
  methods: {
    async getOptions() {
      const token = await this.$auth0.getTokenSilently()
      return {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    },
  },
}
</script>
