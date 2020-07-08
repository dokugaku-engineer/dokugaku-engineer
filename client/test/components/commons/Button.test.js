import { mount } from '@vue/test-utils'
import Button from '~/components/commons/Button.vue'

describe('components/commons/Button.vue', () => {
  test('match snapshot', () => {
    const wrapper = mount(Button)
    expect(wrapper.element).toMatchSnapshot()
  })
})
