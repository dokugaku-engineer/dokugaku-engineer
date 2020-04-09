<template>
  <div>
    <div class="video-wrap">
      <div class="video">
        <iframe
          v-if="lecture.video_url"
          :src="`${lecture.video_url}?autoplay=1&color=26a69a`"
          frameborder="0"
          allow="autoplay; fullscreen"
          allowfullscreen
          style="position:absolute;top:0;left:0;width:100%;height:100%;"
        ></iframe>
      </div>
      <div class="video-btns">
        <div class="video-btn video-btn-prev">
          <nuxt-link
            :to="`/course/${course.name}/lecture/${lecture.prev_lecture_slug}`"
            class="video-btn-link"
          >
            <i class="fas fa-less-than"></i>
          </nuxt-link>
        </div>
        <div v-if="lecture.next_lecture_slug" class="video-btn video-btn-next">
          <nuxt-link
            :to="`/course/${course.name}/lecture/${lecture.next_lecture_slug}`"
            class="video-btn-link"
          >
            <i class="fas fa-greater-than"></i>
          </nuxt-link>
        </div>
      </div>
      <div v-if="loading" class="loading">
        <i class="fad fa-spinner fa-spin fa-lg"></i>
      </div>
    </div>

    <div class="detail">
      <div class="detail-btns">
        <nuxt-link
          v-if="lecture.prev_lecture_slug"
          :to="`/course/${course.name}/lecture/${lecture.prev_lecture_slug}`"
          class="detail-btn-link detail-btn-prev"
        >
          <i class="fas fa-less-than"></i>
        </nuxt-link>
        <nuxt-link
          v-if="lecture.next_lecture_slug"
          :to="`/course/${course.name}/lecture/${lecture.next_lecture_slug}`"
          class="detail-btn-link"
        >
          <i class="fas fa-greater-than"></i>
        </nuxt-link>
      </div>
      <div class="detail-content">
        <h3 class="detail-header">このレクチャーの内容・補足</h3>
        <div class="detail-body">
          <p>{{ lecture.description }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
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

.detail-body {
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

<script>
import ErrorBox from "@/components/commons/ErrorBox.vue"
import VerificationEmailBox from "@/components/partials/course/VerificationEmailBox.vue"
import { mapState, mapGetters } from "vuex"

export default {
  layout: "course",
  components: {
    ErrorBox,
    VerificationEmailBox
  },
  data() {
    return {
      course: {},
      lecture: {},
      loading: true,
      error: null
    }
  },
  computed: {
    ...mapState("auth0", ["auth0User"]),
    ...mapGetters("auth0", ["isAuth0Provider"])
  },
  async created() {
    this.$store.dispatch("course/setCourse", { course: {}, lecture: {} })
    this.$store.dispatch("course/setLectureName", { name: "" })
    await Promise.all([
      this.$axios.$get(`/courses/${this.$route.params.name}/test`),
      this.$axios.$get(`/lectures/rQI62/test`)
    ])
      .then(res => {
        // TODO: lectureが別のコースのデータの場合、404かTOPにリダイレクトさせる
        this.course = res[0]
        this.lecture = res[1]
        this.loading = false
        this.$store.dispatch("course/setCourse", {
          course: this.course,
          lecture: this.lecture
        })
        this.$store.dispatch("course/setLectureName", {
          name: this.lecture.name
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
