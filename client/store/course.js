export const state = () => ({
  course: {},
  lessons: [],
  lecture: {}
})

export const mutations = {
  SET_COURSE(state, {
    course,
    lecture
  }) {
    state.course = course
    state.lecture = lecture
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
  }, {
    course,
    lecture
  }) {
    commit("SET_COURSE", {
      course,
      lecture
    })
  },
}