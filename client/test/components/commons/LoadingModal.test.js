import { mount } from '@vue/test-utils'
import LoadingModal from '~/components/commons/LoadingModal.vue'

describe('components/commons/LoadingModal.vue', () => {
  test('match snapshot', () => {
    const wrapper = mount(LoadingModal)
    expect(wrapper.element).toMatchSnapshot()
  })
})
