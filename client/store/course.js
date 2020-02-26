export const state = () => ({
  course: {},
  lessons: []
})

export const mutations = {
  SET_COURSE(state, course) {
    state.course = course
  },

  SET_LESSONS(state, {
    course,
    lecture
  }) {
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
  }
}

export const actions = {
  setCourse({
    commit
  }, course) {
    commit("SET_COURSE", course)
  },

  setLessons({
    commit
  }, {
    course,
    lecture
  }) {
    commit("SET_LESSONS", {
      course,
      lecture
    })
  },
}