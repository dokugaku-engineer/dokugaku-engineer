import Vuex from 'vuex'
import * as auth0 from '../../store/auth0'
import { createLocalVue } from '@vue/test-utils'
import cloneDeep from 'lodash/cloneDeep'


describe('store/auth0.js', () => {
  let store

  beforeEach(() => {
    const localVue = createLocalVue()
    localVue.use(Vuex)
    store = new Vuex.Store(cloneDeep(auth0))
  })

  describe('mutations', () => {
    test('SET_LOADING ミューテーションがコミットされると、 loading ステートが設定される', () => {
      expect(store.state.loading).toBe(true)
      store.commit('SET_LOADING', false)
      expect(store.state.loading).toBe(false)
    })

    test('SET_IS_AUTHENTICATED ミューテーションがコミットされると、 isAuthenticated ステートが設定される', () => {
      expect(store.state.isAuthenticated).toBe(false)
      store.commit('SET_IS_AUTHENTICATED', true)
      expect(store.state.isAuthenticated).toBe(true)
    })

    test('SET_AUTH0_USER ミューテーションがコミットされると、 auth0User ステートが設定される', () => {
      expect(store.state.auth0User).toEqual({})
      store.commit('SET_AUTH0_USER', { 'id': 1 })
      expect(store.state.auth0User).toEqual({ 'id': 1 })
    })

    test('SET_POPUP_OPEN ミューテーションがコミットされると、 popupOpen ステートが設定される', () => {
      expect(store.state.popupOpen).toBe(false)
      store.commit('SET_POPUP_OPEN', true)
      expect(store.state.popupOpen).toBe(true)
    })

    test('SET_PERMISSIONS ミューテーションがコミットされると、 permissions ステートが設定される', () => {
      expect(store.state.permissions.length).toBe(0)
      store.commit('SET_PERMISSIONS', ['open'])
      expect(store.state.permissions.length).toBe(1)
    })
  })

  describe('getters', () => {
    test('providers ゲッターで、プロバイダー名が返される', () => {
      const key = process.env.AUTH0_NAMESPACE + 'providers'
      store.commit('SET_AUTH0_USER', { [key]: ['github'] })
      expect(store.getters.providers).toEqual(['GitHub'])

      store.commit('SET_AUTH0_USER', { [key]: ['twitter'] })
      expect(store.getters.providers).toEqual(['Twitter'])

      store.commit('SET_AUTH0_USER', { [key]: ['auth0'] })
      expect(store.getters.providers).toEqual(['auth0'])
    })

    test('userId ゲッターで、ユーザー ID が返される', () => {
      const key = process.env.AUTH0_NAMESPACE + 'user_id'
      store.commit('SET_AUTH0_USER', { [key]: 'auth000' })
      expect(store.getters.userId).toEqual('auth000')
    })

    test('isAuth0Provider ゲッターで、auth0 が含まれていたら true を返す', () => {
      const key = process.env.AUTH0_NAMESPACE + 'providers'
      store.commit('SET_AUTH0_USER', { [key]: ['auth0'] })
      expect(store.getters.isAuth0Provider).toBe(true)
    })

    test('isAuth0Provider ゲッターで、auth0 が含まれていなければ false を返す', () => {
      const key = process.env.AUTH0_NAMESPACE + 'providers'
      store.commit('SET_AUTH0_USER', { [key]: ['github'] })
      expect(store.getters.isAuth0Provider).toBe(false)
    })
  })
})
