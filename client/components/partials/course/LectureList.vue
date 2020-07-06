<template>
  <div>
    <div
      class="lesson-title"
      :class="playLesson ? 'play' : ''"
      @click="showLecture = !showLecture"
    >
      <h2>
        レッスン{{ lesson.order }}：
        <span class="lesson-title-detail">{{ lesson.name }}</span>
      </h2>
      <i :class="cheveron" />
    </div>
    <ol v-if="showLecture" class="lecture">
      <li v-for="(lec, index) in lectures" :key="index">
        <nuxt-link
          :to="`/course/${course.name}/lecture/${lec.slug}`"
          class="lecture-link"
          :class="playLecture(lec) ? 'play' : ''"
          @click.native="$emit('hideMenu')"
        >
          <i :class="learned(lec.id) ? 'far fa-check' : 'fas fa-circle'" />
          {{ lec.order }}. {{ lec.name }}
        </nuxt-link>
      </li>
    </ol>
  </div>
</template>

<style lang="scss" scoped>
.lesson {
  margin-bottom: 1.2rem;
}

.lesson-course {
  border-bottom: 1px solid $color-gray1;
  margin-bottom: 1.2rem;
}

.lesson-title {
  align-items: center;
  background-color: $color-white2;
  border-radius: 0.8rem;
  cursor: pointer;
  display: flex;
  margin: 1rem 0;
  padding: 0.8rem 1.6rem;

  h2,
  i {
    display: inline-block;
  }

  h2 {
    margin-right: 1.6rem;
  }

  i {
    margin-left: auto;
  }
}

.lesson-title-detail {
  font-weight: 400;
}

.lecture {
  li {
    padding: 1rem 1.6rem;
  }
}

.lecture-link {
  display: block;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: normal;

  i {
    margin-right: 1.4rem;
  }

  .fa-check {
    color: $color-teal1;
  }

  .fa-circle {
    color: $color-gray2;
  }
}

@media screen and (min-width: 769px) {
  .lecture-link {
    white-space: nowrap;
  }
}

.play {
  color: $color-black;
  font-weight: 700;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>

<script>
export default {
  props: {
    course: {
      type: Object,
      default: () => ({}),
    },
    lesson: {
      type: Object,
      default: () => ({}),
    },
    lecture: {
      type: Object,
      default: () => ({}),
    },
    lectures: {
      type: Array,
      default: () => [],
    },
    learnedLectureIds: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      showLecture: false,
    }
  },
  computed: {
    cheveron() {
      if (this.showLecture) {
        return "far fa-chevron-up"
      } else {
        return "far fa-chevron-down"
      }
    },
    playLesson() {
      if (!Object.keys(this.lecture).length) {
        return false
      }
      return this.lesson.id === this.lecture.lesson_id
    },
  },
  methods: {
    learned(lectureId) {
      return this.learnedLectureIds.includes(lectureId)
    },
    playLecture(lecture) {
      if (!Object.keys(this.lecture).length) {
        return false
      }
      return this.lecture.id === lecture.id
    },
  },
}
</script>
