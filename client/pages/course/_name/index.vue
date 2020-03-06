<template>
  <div>
    <div class="header">
      <h3 class="header-title">カリキュラム</h3>
      <p class="header-text">{{ course.description }}</p>
    </div>
    <div class="main">
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
  border-radius: .5rem;
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
  margin-bottom: .7rem;
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
import LectureList from "@/components/partials/course/LectureList.vue"
import auth0Middleware from '~/middleware/auth0'
import { mapState } from 'vuex'

export default {
  layout: "course",
  components: {
    LectureList,
  },
  data() {
    return {
      course: {},
      loading: true
    }
  },
  computed: {
    ...mapState('course', ['course'])
  },
  middleware: auth0Middleware.protect(),
  async created() {
    this.$store.dispatch('course/setLectureName', { name: 'ホーム' })
    await this.$axios.$get(`/courses/${this.$route.params.name}/lectures`)
      .then((res) => {
        this.course = res
        this.loading = false
        this.$store.dispatch('course/setCourse', { course: this.course, lecture: {} })
      }).catch((e) => {
        this.$router.push('/')
      })
  }
}
</script>
