export const state = () => ({
  course: {},
  courseTop: false,
  lessons: [],
  lecture: {},
  lectureName: '',
  learnedLectureIds: []
})

export const mutations = {
  SET_COURSE(state, {
    course,
    lecture
  }) {
    state.course = course
    state.lecture = lecture

    if (!Object.keys(course).length) {
      return
    }

    if (!Object.keys(lecture).length) {
      state.courseTop = true
    } else {
      state.courseTop = false
    }

    let lessons = course.parts.map(part => part.lessons).flat()

    lessons.forEach(lesson => {
      let lessonPlay = false
      lesson.lectures.forEach(lec => {
        lec.play = false
        if (lecture.id == lec.id) {
          lec.play = true
          lessonPlay = true
        }
      })
      lesson.play = lessonPlay
    });

    state.lessons = lessons
  },

  SET_LECTURE_NAME(state, {
    name
  }) {
    state.lectureName = name
  },

  SET_LEARNED_LECTURE_IDS(state, {
    learningHistories
  }) {
    state.learnedLectureIds = learningHistories
  }
}

export const actions = {
  setCourse({
    commit
  }, {
    course,
    lecture
  }) {
    commit("SET_COURSE", {
      course,
      lecture
    })
  },

  setLectureName({
    commit
  }, {
    name
  }) {
    commit("SET_LECTURE_NAME", {
      name
    })
  },

  setLearnedLectureIds({
    commit
  }, {
    learningHistories
  }) {
    commit("SET_LEARNED_LECTURE_IDS", {
      learningHistories
    })
  }
}