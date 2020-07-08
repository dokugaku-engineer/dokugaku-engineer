import Vuex from 'vuex'
import * as index from '../../store/index'
import { createLocalVue } from '@vue/test-utils'
import cloneDeep from 'lodash/cloneDeep'


describe('store/index.js', () => {
  let store

  beforeEach(() => {
    const localVue = createLocalVue()
    localVue.use(Vuex)
    store = new Vuex.Store(cloneDeep(index))
  })

  describe('actions', () => {
    test('setTitle アクションを dispatch すると、 title ステートが設定される', async () => {
      expect(store.state.title).toEqual('')
      await store.dispatch('setTitle', 'ページタイトル')
      expect(store.state.title).toEqual('ページタイトル')
    })
  })
})
