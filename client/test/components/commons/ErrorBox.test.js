import { mount } from '@vue/test-utils'
import ErrorBox from '~/components/commons/ErrorBox.vue'

describe('components/commons/ErrorBox.vue', () => {
  test('match snapshot', () => {
    const wrapper = mount(ErrorBox)
    expect(wrapper.element).toMatchSnapshot()
  })
})
