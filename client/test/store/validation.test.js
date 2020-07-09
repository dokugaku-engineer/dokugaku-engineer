import Vuex from 'vuex'
import * as validation from '../../store/validation'
import { createLocalVue } from '@vue/test-utils'
import cloneDeep from 'lodash/cloneDeep'

describe('store/validation.js', () => {
  let store

  beforeEach(() => {
    const localVue = createLocalVue()
    localVue.use(Vuex)
    store = new Vuex.Store(cloneDeep(validation))
  })

  describe('actions', () => {
    test('setErrors アクションを dispatch すると、 errors ステートが設定される', async () => {
      expect(store.state.errors).toEqual({})
      await store.dispatch('setErrors', { error: 'unauthorized error' })
      expect(store.state.errors).toEqual({ error: 'unauthorized error' })
    })

    test('clearErrors アクションを dispatch すると、 errors ステートがクリアされる', async () => {
      await store.dispatch('setErrors', { error: 'unauthorized error' })
      expect(store.state.errors).toEqual({ error: 'unauthorized error' })
      await store.dispatch('clearErrors')
      expect(store.state.errors).toEqual({})
    })
  })
})
