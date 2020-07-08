import {  mount, RouterLinkStub } from '@vue/test-utils'
import LinkButton from '~/components/commons/LinkButton.vue'

describe('components/commons/LinkButton.vue', () => {
  test('match snapshot', () => {
    const wrapper = mount(LinkButton, {
      stubs: {
        NLink: RouterLinkStub,
      },
    })
    expect(wrapper.element).toMatchSnapshot()
  })
})
