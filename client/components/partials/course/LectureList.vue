<template>
  <transion name="fade">
    <div @click="showLecture = !showLecture" class="lesson-title" :class="lesson.lessonPlay ? 'play' : ''">
      <h2>
        レッスン{{ lesson.lessonNo }}：<span class="lesson-title-detail">{{ lesson.lessonTitle }}</span>
      </h2>
      <i :class="cheveron"></i>
    </div>
    <ol v-if="showLecture" class="lecture">
      <li v-for="lecture in lesson.lectures">
        <a href="" class="lecture-link" :class="lecture.lecturePlay ? 'play' : ''">
          <i class="far fa-check"></i>
          {{ lecture.lectureNo }}. {{ lecture.lectureTitle }}
        </a>
      </li>
    </ol>
  </transion>
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
  white-space: nowrap;

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

.play {
  color: $color-black;
  font-weight: 700;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>

<script>

export default {
  props: {
    lesson: {
      type: Object,
      default: {}
    }
  },
  data() {
    return {
      lesson: this.lesson,
      showLecture: false,
    }
  },
  computed: {
    cheveron() {
      if (this.showLecture) {
        return "far fa-chevron-up";
      } else {
        return "far fa-chevron-down";
      }
    }
  }
}
</script>