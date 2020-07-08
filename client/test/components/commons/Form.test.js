import { mount } from '@vue/test-utils'
import Form from '~/components/commons/Form.vue'

describe('components/commons/Form.vue', () => {
  test('match snapshot', () => {
    const wrapper = mount(Form)
    expect(wrapper.element).toMatchSnapshot()
  })
})
