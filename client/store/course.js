export const state = () => ({
  course: {},
  parts: [],
  lessons: [],
  lectures: [],
  lecture: {},
  learnedLectureIds: [],
  lectureName: '',
  courseTop: false
})

export const mutations = {
  SET_COURSE(state, $payload) {
    state.course = $payload
  },

  SET_PARTS(state, $payload) {
    state.parts = $payload
  },

  SET_LESSONS(state, $payload) {
    state.lessons = $payload
  },

  SET_LECTURES(state, $payload) {
    state.lectures = $payload
  },

  SET_LECTURE(state, $payload) {
    state.lecture = $payload
  },

  SET_LEARNED_LECTURE_IDS(state, $payload) {
    state.learnedLectureIds = $payload
  },

  SET_LECTURE_NAME(state, $payload) {
    state.lectureName = $payload
  },

  SET_COURSE_TOP(state, $payload) {
    state.courseTop = $payload
  },
}

export const actions = {
  setCourse({
    commit
  }, $payload) {
    commit("SET_COURSE", $payload)
  },

  setParts({
    commit
  }, $payload) {
    commit("SET_PARTS", $payload)
  },

  setLessons({
    commit
  }, $payload) {
    commit("SET_LESSONS", $payload)
  },

  setLectures({
    commit
  }, $payload) {
    commit("SET_LECTURES", $payload)
  },

  setLecture({
    commit
  }, $payload) {
    commit("SET_LECTURE", $payload)
  },

  setLearnedLectureIds({
    commit
  }, $payload) {
    commit("SET_LEARNED_LECTURE_IDS", $payload)
  },

  setLectureName({
    commit
  }, $payload) {
    commit("SET_LECTURE_NAME", $payload)
  },

  setCourseTop({
    commit
  }, $payload) {
    commit("SET_COURSE_TOP", $payload)
  },
}

export const getters = {
  filteredLessons: (state) => (partId) => {
    return state.lessons.filter(lesson => {
      return lesson.part_id === partId
    })
  },

  filteredLectures: (state) => (lessonId) => {
    return state.lectures.filter(lecture => {
      return lecture.lesson_id === lessonId
    })
  },
}