<template>
  <div>
    <div @click="showLecture = !showLecture" class="lesson-title" :class="lesson.play ? 'play' : ''">
      <h2>
        レッスン{{ lesson.order }}：<span class="lesson-title-detail">{{ lesson.name }}</span>
      </h2>
      <i :class="cheveron"></i>
    </div>
    <ol v-if="showLecture" class="lecture">
      <li v-for="lecture in lesson.lectures">
        <nuxt-link
          :to="`/course/${$store.state.course.course.name}/lecture/${lecture.slug}`"
          @click.native="$emit('hideMenu')"
          class="lecture-link"
          :class="lecture.play ? 'play' : ''"
        >
          <i :class="lecture.learned ? 'far fa-check' : 'fas fa-circle'"></i>
          {{ lecture.order }}. {{ lecture.name }}
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
  border-radius: .8rem;
  cursor: pointer;
  display: flex;
  margin: 1rem 0;
  padding: .8rem 1.6rem;

  h2, i {
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

.fade-enter-active, .fade-leave-active {
  transition: opacity .2s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>

<script>

export default {
  props: {
    lessonLectures: {
      type: Object,
      default: () => {}
    }
  },
  data() {
    return {
      showLecture: false,
    }
  },
  computed: {
    cheveron() {
      if (!this.lesson.lectures.length) {
        return "";
      } else if (this.showLecture) {
        return "far fa-chevron-up";
      } else {
        return "far fa-chevron-down";
      }
    },
    lesson() {
      return this.lessonLectures
    }
  }
}
</script>
