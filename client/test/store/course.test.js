import Vuex from 'vuex'
import * as course from '../../store/course'
import { createLocalVue } from '@vue/test-utils'
import cloneDeep from 'lodash/cloneDeep'

describe('store/course.js', () => {
  let store

  beforeEach(() => {
    const localVue = createLocalVue()
    localVue.use(Vuex)
    store = new Vuex.Store(cloneDeep(course))
  })

  describe('actions', () => {
    test('setCourse アクションを dispatch すると、 course ステートが設定される', async () => {
      expect(store.state.course).toEqual({})
      await store.dispatch('setCourse', { name: 'serverside' })
      expect(store.state.course).toEqual({ name: 'serverside' })
    })

    test('setParts アクションを dispatch すると、 parts ステートが設定される', async () => {
      expect(store.state.parts.length).toBe(0)
      await store.dispatch('setParts', [{ name: 'first part' }])
      expect(store.state.parts.length).toBe(1)
    })

    test('setLessons アクションを dispatch すると、 lessons ステートが設定される', async () => {
      expect(store.state.lessons.length).toBe(0)
      await store.dispatch('setLessons', [{ name: 'first lesson' }])
      expect(store.state.lessons.length).toBe(1)
    })

    test('setLectures アクションを dispatch すると、 lectures ステートが設定される', async () => {
      expect(store.state.lectures.length).toBe(0)
      await store.dispatch('setLectures', [{ name: 'first lecture' }])
      expect(store.state.lectures.length).toBe(1)
    })

    test('setLecture アクションを dispatch すると、 lecture ステートが設定される', async () => {
      expect(store.state.lecture).toEqual({})
      await store.dispatch('setLecture', { name: 'first lecture' })
      expect(store.state.lecture).toEqual({ name: 'first lecture' })
    })

    test('setLearnedLectureIds アクションを dispatch すると、 learnedLectureIds ステートが設定される', async () => {
      expect(store.state.learnedLectureIds.length).toBe(0)
      await store.dispatch('setLearnedLectureIds', [1])
      expect(store.state.learnedLectureIds.length).toBe(1)
    })

    test('setCourseTop アクションを dispatch すると、 courseTop ステートが設定される', async () => {
      expect(store.state.courseTop).toBe(false)
      await store.dispatch('setCourseTop', true)
      expect(store.state.courseTop).toBe(true)
    })
  })

  describe('getters', () => {
    test('filteredLessons　ゲッターで、フィルターされた Lessons が返される', async () => {
      await store.dispatch('setLessons', [
        { id: 1, part_id: 1 },
        { id: 2, part_id: 1 },
        { id: 3, part_id: 2 },
      ])
      expect(store.getters.filteredLessons(1).length).toBe(2)
    })

    test('filteredLectures　ゲッターで、フィルターされた Lectures が返される', async () => {
      await store.dispatch('setLectures', [
        { id: 1, lesson_id: 1 },
        { id: 2, lesson_id: 1 },
        { id: 3, lesson_id: 2 },
      ])
      expect(store.getters.filteredLectures(1).length).toBe(2)
    })

    test('lastLecture　ゲッターで、最後の Lecture が返される', async () => {
      await store.dispatch('setLectures', [
        { id: 1, lesson_id: 1, order: 1 },
        { id: 2, lesson_id: 1, order: 2 },
        { id: 3, lesson_id: 2, order: 3 },
      ])
      expect(store.getters.lastLecture().order).toBe(3)
    })
  })
})
